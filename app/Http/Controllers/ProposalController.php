<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Dosen;
use App\Models\JurusanProposal;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    // Mahasiswa menyimpan data proposal
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:20',
            'judul' => 'required|string|max:255',
            'file_proposal' => 'required|mimes:doc,docx|max:10240', // Maksimal 10MB
        ]);

        try {
            $filePath = $request->file('file_proposal')->store('proposals', 'public');

            $proposal = Proposal::create([
                'nama' => $request->nama,
                'npm' => $request->npm,
                'judul' => $request->judul,
                'file_proposal' => $filePath,
                'status' => 'Menunggu', // Status default
                'pesan' => null, // Pesan kosong
                'dospem_id' => null, // Belum ada dosen pembimbing
            ]);

            return redirect('/mahasiswa')->with('success', 'Proposal berhasil diajukan!');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat menyimpan data proposal.', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect('/mahasiswa')->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!');
        }
    }

    public function adminIndex(Request $request)
    {
        // Ambil parameter pencarian dari query string
        $search = $request->input('search');

        // Cek apakah parameter pencarian ada dan filter proposal
        if ($search) {
            $proposals = Proposal::where('nama', 'like', '%' . $search . '%')
                ->orWhere(
                    'npm',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere('judul', 'like', '%' . $search . '%')
                ->get();
        } else {
            // Jika tidak ada pencarian, tampilkan semua proposal
            $proposals = Proposal::all();
        }

        // Kirim data proposal ke view
        return view('admin.index', compact('proposals'));
    }

    public function edit($id)
    {
        // Ambil proposal berdasarkan ID
        $proposal = Proposal::findOrFail($id);

        // Ambil semua dosen yang ada
        $dosen = Dosen::all();  // Atau Anda bisa menambahkan kondisi lain untuk mengambil dosen tertentu

        // Kirim data proposal dan dosen ke view
        return view('admin.edit', compact('proposal', 'dosen'));
    }

    // Admin memperbarui data proposal
    public function update(Request $request, $id)
    {
        Log::info('Proses update data proposal dimulai.', ['id' => $id]);
        Log::info('Data yang diterima untuk update:', $request->all());

        $request->validate([
            'dospem_id' => 'required|exists:dosen,id',  // Validasi ID dosen
            'status' => 'required|string|in:Diterima,Revisi',
            'pesan' => 'nullable|string|max:500',
        ]);

        $proposal = Proposal::findOrFail($id);  // Mengambil proposal berdasarkan ID

        // Log sebelum data diupdate
        Log::info('Data proposal sebelum diperbarui.', ['proposal' => $proposal]);

        // Update proposal
        $proposal->update([
            'dospem_id' => $request->dospem_id, // Menyimpan ID dosen pembimbing
            'status' => $request->status,
            'pesan' => $request->pesan,
        ]);

        // Log setelah data diupdate
        Log::info('Data proposal berhasil diperbarui.', ['proposal' => $proposal]);

        // Jika status "Diterima", kirimkan data ke jurusan
        if ($request->status == 'Diterima') {
            $this->sendToJurusan($proposal);
        }

        return redirect()->route('admin.index')->with('success', 'Proposal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cari proposal berdasarkan ID
        $proposal = Proposal::findOrFail($id);

        // Cek apakah ada file yang terkait dengan proposal dan hapus file tersebut
        if ($proposal->file_proposal && Storage::exists('public/' . $proposal->file_proposal)) {
            Storage::delete('public/' . $proposal->file_proposal);
        }

        // Hapus proposal dari database
        $proposal->delete();

        return redirect()->route('admin.index')->with('success', 'Proposal berhasil dihapus!');
    }


    /**
     * Mengirimkan data ke jurusan jika proposal diterima
     */
    private function sendToJurusan(Proposal $proposal)
    {
        try {
            Log::info('Mengirim data ke jurusan.', [
                'nama' => $proposal->nama,
                'npm' => $proposal->npm,
                'judul' => $proposal->judul,
                'dospem' => $proposal->dospem->nama,
            ]);

            // Simpan data ke tabel jurusan_proposals menggunakan Eloquent
            $jurusanProposal = JurusanProposal::create([
                'proposal_id' => $proposal->id,
                'nama' => $proposal->nama,
                'npm' => $proposal->npm,
                'judul' => $proposal->judul,
                'dospem_id' => $proposal->dospem_id,
                'status' => $proposal->status,
            ]);


            Log::info('Data proposal berhasil dikirim ke jurusan.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim data ke jurusan.', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    // Jurusan menerima data dari admin
    public function jurusanIndex()
    {
        // Mengambil proposal yang diterima beserta dospem dan file_proposal
        $proposals = JurusanProposal::with('proposal.dospem') // Mengambil dosen dari relasi proposal
            ->where('status', 'Diterima')
            ->get();

        // Log data proposal dan dospem yang diterima
        Log::info('Data proposals diterima dengan dospem: ', $proposals->map(function ($jurusanProposal) {
            $proposal = $jurusanProposal->proposal;
            $dospemNama = $proposal && $proposal->dospem ? $proposal->dospem->nama : 'Tidak ada dospem';
            $fileProposal = $proposal ? $proposal->file_proposal : 'Tidak ada file';

            return [
                'proposal_id' => $jurusanProposal->proposal_id,
                'dospem' => $dospemNama,
                'file_proposal' => $fileProposal,
            ];
        })->toArray());

        return view('jurusan.index', compact('proposals'));
    }
}
