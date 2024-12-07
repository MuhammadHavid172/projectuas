@extends('layouts.app')

@section('title', 'About')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Judul -->
        <h1 class="text-4xl font-semibold text-center text-blue-600 mb-6">About ProposalApp</h1>
        
        <!-- Deskripsi -->
        <div class="text-center">
            <p class="text-lg text-gray-700 mb-4">
                ProposalApp adalah platform untuk mempermudah proses pendaftaran proposal mahasiswa.
            </p>
            <p class="text-gray-600">
                Dengan ProposalApp, mahasiswa dapat dengan mudah mengajukan proposal untuk mendapatkan persetujuan dari dosen pembimbing tanpa melalui proses manual yang memakan waktu. Aplikasi ini dirancang untuk memberikan kemudahan bagi mahasiswa dalam mengelola proposal mereka secara efisien.
            </p>
        </div>

        <!-- Fitur atau Keunggulan -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Pendaftaran Mudah</h3>
                <p class="text-gray-600">Pengguna dapat mendaftar proposal dengan beberapa klik tanpa kerumitan.</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Tinjauan Dosen</h3>
                <p class="text-gray-600">Dosen dapat dengan mudah meninjau dan memberikan umpan balik pada proposal yang diajukan mahasiswa.</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Notifikasi</h3>
                <p class="text-gray-600">Mahasiswa dan dosen akan menerima notifikasi untuk setiap update terkait proposal mereka.</p>
            </div>
        </div>
    </div>
@endsection
