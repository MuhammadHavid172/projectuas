@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12 text-center">
    <h1 class="text-4xl font-semibold text-gray-900">Welcome to ProposalApp</h1>
    <p class="mt-4 text-lg text-gray-600">Sistem Pendaftaran Proposal Mahasiswa.</p>

    @auth
    @if(auth()->user()->hasRole('admin'))
    <!-- Konten untuk Admin -->
    <div class="mt-8 bg-blue-100 p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800">Halo Admin!</h2>
        <p class="mt-4 text-lg text-gray-700">Anda dapat mengelola pendaftaran proposal di sini.</p>
        <a href="{{ url('/admin') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition">Kelola Proposal</a>
    </div>
    @elseif (auth()->user()->hasRole('mahasiswa'))
    <!-- Konten untuk Mahasiswa -->
    <div class="mt-8 bg-green-100 p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800">Halo Mahasiswa!</h2>
        <p class="mt-4 text-lg text-gray-700">Silakan daftarkan proposal Anda di sini.</p>
        <a href="{{ url('/mahasiswa') }}" class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded-full hover:bg-green-700 transition">Daftar Proposal</a>
    </div>
    @elseif (auth()->user()->hasRole('Jurusan'))
    <!-- Konten untuk Jurusan -->
    <div class="mt-8 bg-purple-100 p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800">Halo Jurusan!</h2>
        <p class="mt-4 text-lg text-gray-700">Anda dapat melihat data proposal yang telah diterima di sini.</p>
        <a href="{{ url('/jurusan') }}" class="mt-4 inline-block bg-purple-600 text-white py-2 px-4 rounded-full hover:bg-purple-700 transition">Lihat Data Proposal</a>
    </div>
    @else
    <!-- Konten untuk User Tanpa Role -->
    <div class="mt-8 bg-yellow-100 p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800">Halo Pengguna!</h2>
        <p class="mt-4 text-lg text-gray-700">Anda tidak memiliki role yang ditentukan. Hubungi administrator.</p>
    </div>
    @endif
    @else
    <!-- Konten untuk Pengguna yang Belum Login -->
    <div class="mt-8 bg-gray-100 p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800">Silakan Login</h2>
        <p class="mt-4 text-lg text-gray-700">Untuk mengakses fitur, silakan login terlebih dahulu.</p>
        <a href="{{ route('login') }}" class="mt-4 inline-block bg-indigo-600 text-white py-2 px-4 rounded-full hover:bg-indigo-700 transition">Login</a>
    </div>
    @endauth
</div>
@endsection