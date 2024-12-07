<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Dosen;
use Illuminate\Support\Facades\Log;

class ProposalController extends Controller
{
    // Mahasiswa menyimpan data proposal
    public function store(Request $request)
    {
        // Tambahkan log awal untuk memulai proses
        Log::info('Mulai proses penyimpanan data proposal oleh mahasiswa.', ['request' => $request->all()]);

        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:20',
            'judul' => 'required|string|max:255',
            'file_proposal' => 'required|mimes:doc,docx|max:10240', // Maksimal 10MB
        ]);

        try {
            // Log sebelum upload file
            Log::info('Proses upload file dimulai.');

            // Mengunggah file proposal ke storage
            $filePath = $request->file('file_proposal')->store('proposals', 'public');

            // Log setelah file berhasil diupload
            Log::info('File berhasil diupload.', ['filePath' => $filePath]);

            // Menyimpan data proposal ke database
            $proposal = Proposal::create([
                'nama' => $request->nama,
                'npm' => $request->npm,
                'judul' => $request->judul,
                'file_proposal' => $filePath,
                'status' => 'Menunggu', // Status default
                'pesan' => null, // Pesan kosong
                'dospem' => null, // Belum ada dosen pembimbing
            ]);

            // Log setelah data berhasil disimpan
            Log::info('Proposal berhasil disimpan ke database.', ['proposal' => $proposal]);

            // Redirect dengan pesan sukses
            return redirect('/mahasiswa')->with('success', 'Proposal berhasil diajukan!');
        } catch (\Exception $e) {
            // Log jika terjadi kesalahan
            Log::error('Terjadi kesalahan saat menyimpan data proposal.', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            // Redirect dengan pesan error
            return redirect('/mahasiswa')->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!');
        }
    }

    // Admin menampilkan daftar proposal
    public function index(Request $request)
    {
        $query = Proposal::query();

        // Pencarian berdasarkan nama, npm, atau judul
        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $query->where('nama', 'like', "%{$searchTerm}%")
                ->orWhere('npm', 'like', "%{$searchTerm}%")
                ->orWhere('judul', 'like', "%{$searchTerm}%");
        }

        // Memuat relasi dospem dan mengambil data proposal yang sesuai dengan query
        $proposals = $query->with('dospem')->get();
        
        foreach ($proposals as $proposal) {
            Log::info('Proposal Dospem:', ['dospem' => $proposal->dospem]);
        }

        return view('admin.index', compact('proposals'));
    }

    // Admin mengedit data proposal
    public function edit($id)
    {
        Log::info('Proses edit data proposal dimulai.', ['id' => $id]);

        $proposal = Proposal::findOrFail($id);
        $dosen = Dosen::all();

        Log::info('Proposal yang akan diedit ditemukan.', ['proposal' => $proposal]);

        return view('admin.edit', compact('proposal', 'dosen'));
    }

    // Admin memperbarui data proposal
    public function update(Request $request, $id)
    {
        Log::info('Proses update data proposal dimulai.', ['id' => $id]);

        $request->validate([
            'dospem' => 'required|string|max:255',
            'status' => 'required|string|in:Diterima,Revisi',
            'pesan' => 'nullable|string|max:500',
        ]);

        $proposal = Proposal::findOrFail($id);

        // Log sebelum data diupdate
        Log::info('Data proposal sebelum diperbarui.', ['proposal' => $proposal]);

        // Update proposal
        $proposal->update([
            'dospem' => $request->dospem,
            'status' => $request->status,
            'pesan' => $request->pesan,
        ]);

        // Log setelah data diupdate
        Log::info('Data proposal berhasil diperbarui.', ['proposal' => $proposal]);

        return redirect()->route('admin.index')->with('success', 'Proposal berhasil diperbarui!');
    }

    // Jurusan menerima data dari admin (KTA)
    public function jurusanIndex()
    {
        // Data proposal yang telah diterima
        $proposals = Proposal::where('status', 'Diterima')->get();

        return view('jurusan.index', compact('proposals'));
    }
}
