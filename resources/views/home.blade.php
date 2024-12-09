@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12 text-center">
    <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-500 to-pink-500">
        Welcome to ProposalApp
    </h1>
    <p class="mt-4 text-xl text-gray-600">Sistem Pendaftaran Proposal Mahasiswa.</p>

    @auth
    @if(auth()->user()->hasRole('admin'))
    <!-- Konten untuk Admin -->
    <div class="mt-8 bg-gradient-to-r from-blue-100 via-blue-50 to-blue-100 p-6 rounded-xl shadow-lg">
        <h2 class="text-4xl font-bold text-gray-800 flex items-center justify-center">
            <i class="fas fa-user-shield text-blue-500 mr-3"></i> Halo Admin!
        </h2>
        <p class="mt-4 text-lg text-gray-700">Anda dapat mengelola pendaftaran proposal di sini.</p>
        <a href="{{ url('/admin') }}"
            class="mt-6 inline-block bg-blue-600 text-white py-3 px-6 rounded-full hover:shadow-xl hover:bg-blue-700 transition-transform transform hover:scale-105">
            Kelola Proposal
        </a>
    </div>
    @elseif (auth()->user()->hasRole('mahasiswa'))
    <!-- Konten untuk Mahasiswa -->
    <div class="mt-8 bg-gradient-to-r from-green-100 via-green-50 to-green-100 p-6 rounded-xl shadow-lg">
        <h2 class="text-4xl font-bold text-gray-800 flex items-center justify-center">
            <i class="fas fa-graduation-cap text-green-500 mr-3"></i> Halo Mahasiswa!
        </h2>
        <p class="mt-4 text-lg text-gray-700">Silakan daftarkan proposal Anda di sini.</p>
        <a href="{{ url('/mahasiswa') }}"
            class="mt-6 inline-block bg-green-600 text-white py-3 px-6 rounded-full hover:shadow-xl hover:bg-green-700 transition-transform transform hover:scale-105">
            Daftar Proposal
        </a>
    </div>
    @elseif (auth()->user()->hasRole('Jurusan'))
    <!-- Konten untuk Jurusan -->
    <div class="mt-8 bg-gradient-to-r from-purple-100 via-purple-50 to-purple-100 p-6 rounded-xl shadow-lg">
        <h2 class="text-4xl font-bold text-gray-800 flex items-center justify-center">
            <i class="fas fa-building text-purple-500 mr-3"></i> Halo Jurusan!
        </h2>
        <p class="mt-4 text-lg text-gray-700">Anda dapat melihat data proposal yang telah diterima di sini.</p>
        <a href="{{ url('/jurusan') }}"
            class="mt-6 inline-block bg-purple-600 text-white py-3 px-6 rounded-full hover:shadow-xl hover:bg-purple-700 transition-transform transform hover:scale-105">
            Lihat Data Proposal
        </a>
    </div>
    @else
    <!-- Konten untuk User Tanpa Role -->
    <div class="mt-8 bg-gradient-to-r from-yellow-100 via-yellow-50 to-yellow-100 p-6 rounded-xl shadow-lg">
        <h2 class="text-4xl font-bold text-gray-800 flex items-center justify-center">
            <i class="fas fa-exclamation-circle text-yellow-500 mr-3"></i> Halo Pengguna!
        </h2>
        <p class="mt-4 text-lg text-gray-700">Anda tidak memiliki role yang ditentukan. Hubungi administrator.</p>
    </div>
    @endif
    @else
    <!-- Konten untuk Pengguna yang Belum Login -->
    <div class="mt-8 bg-gradient-to-r from-gray-100 via-gray-50 to-gray-100 p-6 rounded-xl shadow-lg">
        <h2 class="text-4xl font-bold text-gray-800 flex items-center justify-center">
            <i class="fas fa-sign-in-alt text-indigo-500 mr-3"></i> Silakan Login
        </h2>
        <p class="mt-4 text-lg text-gray-700">Untuk mengakses fitur, silakan login terlebih dahulu.</p>
        <a href="{{ route('login') }}"
            class="mt-6 inline-block bg-indigo-600 text-white py-3 px-6 rounded-full hover:shadow-xl hover:bg-indigo-700 transition-transform transform hover:scale-105">
            Login
        </a>
    </div>
    @endauth
</div>
@endsection