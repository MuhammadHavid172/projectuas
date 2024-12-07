@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Judul Halaman -->
        <h1 class="text-4xl font-semibold text-center text-blue-600 mb-6">Daftar Pendaftaran Proposal</h1>

        <!-- Form Pencarian -->
        <div class="mb-4 flex justify-end">
            <form method="GET" action="{{ route('admin.index') }}" class="flex items-center">
                <input type="text" name="search" placeholder="Cari proposal..." class="px-4 py-2 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request()->get('search') }}">
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">Search</button>
            </form>
        </div>

        <!-- Tabel Pendaftaran Proposal -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
            <table class="min-w-full table-auto">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">NPM</th>
                        <th class="px-4 py-3 text-left">Judul</th>
                        <th class="px-4 py-3 text-left">Dosen Pembimbing</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Pesan</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($proposals->isEmpty())
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-center text-gray-500">Belum ada data yang terdaftar</td>
                        </tr>
                    @else
                        @foreach ($proposals as $index => $proposal)
                            <tr class="border-t hover:bg-gray-100 transition duration-300">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $proposal->nama }}</td>
                                <td class="px-4 py-3">{{ $proposal->npm }}</td>
                                <td class="px-4 py-3">{{ $proposal->judul }}</td>
                                <td class="px-4 py-3">{{ $proposal->dospem ? $proposal->dospem->nama : '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded {{ $proposal->status == 'Diterima' ? 'bg-green-200 text-green-700' : ($proposal->status == 'Revisi' ? 'bg-yellow-200 text-yellow-700' : 'bg-gray-200 text-gray-700') }} text-sm font-semibold">
                                        {{ $proposal->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $proposal->pesan ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.proposal.edit', $proposal->id) }}" class="text-blue-600 hover:text-blue-800 mr-4 transform hover:scale-110 transition duration-200">Edit</a>
                                    
                                    <!-- Tombol Hapus -->
                                    <button 
                                        class="text-red-600 hover:text-red-800 transform hover:scale-110 transition duration-200" 
                                        onclick="confirmDelete({{ $proposal->id }})">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert2 Script -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, lakukan penghapusan
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <!-- Form Hapus Proposal -->
    @foreach ($proposals as $proposal)
        <form id="delete-form-{{ $proposal->id }}" action="{{ route('admin.proposal.destroy', $proposal->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
@endsection
