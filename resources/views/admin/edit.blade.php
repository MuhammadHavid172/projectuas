@extends('layouts.app')

@section('title', 'Edit Proposal')

@section('content')
<div class="container mx-auto p-6">
    <!-- Judul Halaman -->
    <h1 class="text-4xl font-semibold text-center text-gradient mb-6">Edit Proposal</h1>
    <p class="text-center text-gray-500 mb-8">Silakan perbarui data proposal dengan mengisi form berikut</p>

    <!-- Form Edit Proposal -->
    <div class="bg-white shadow-xl rounded-lg p-8 transition duration-300 hover:shadow-2xl">
        <form action="{{ route('admin.proposal.update', $proposal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-6">
                <label for="nama" class="block text-gray-700 font-medium mb-2">Nama</label>
                <div class="relative">
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $proposal->nama) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required readonly>
                    <i class="absolute right-4 top-3.5 text-gray-400 fas fa-user"></i>
                </div>
                @error('nama')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- NPM -->
            <div class="mb-6">
                <label for="npm" class="block text-gray-700 font-medium mb-2">NPM</label>
                <div class="relative">
                    <input type="text" name="npm" id="npm" value="{{ old('npm', $proposal->npm) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required readonly>
                    <i class="absolute right-4 top-3.5 text-gray-400 fas fa-id-card"></i>
                </div>
                @error('npm')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Judul Proposal -->
            <div class="mb-6">
                <label for="judul" class="block text-gray-700 font-medium mb-2">Judul Proposal</label>
                <div class="relative">
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $proposal->judul) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required readonly>
                    <i class="absolute right-4 top-3.5 text-gray-400 fas fa-book"></i>
                </div>
                @error('judul')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilih Dosen -->
            <div class="mb-6">
                <label for="dosen" class="block text-gray-700 font-medium mb-2">Dosen Pembimbing</label>
                <div class="relative">
                    <select name="dospem_id" id="dosen" class="appearance-none w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 bg-white">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosen as $d)
                        <option value="{{ $d->id }}" {{ old('dospem_id', $proposal->dospem_id) == $d->id ? 'selected' : '' }}>
                            {{ $d->nama }}
                        </option>
                        @endforeach
                    </select>
                    <i class="absolute right-4 top-3.5 text-gray-400 fas fa-chevron-down"></i>
                </div>
            </div>

            <!-- Status Proposal -->
            <div class="mb-6">
                <label for="status" class="block text-gray-700 font-medium mb-2">Status Proposal</label>
                <div class="relative">
                    <select name="status" id="status" class="appearance-none w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 bg-white">
                        <option value="Menunggu" {{ old('status', $proposal->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diterima" {{ old('status', $proposal->status) == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Revisi" {{ old('status', $proposal->status) == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                    </select>
                    <i class="absolute right-4 top-3.5 text-gray-400 fas fa-chevron-down"></i>
                </div>
            </div>

            <!-- Pesan untuk Mahasiswa -->
            <div class="mb-6">
                <label for="pesan" class="block text-gray-700 font-medium mb-2">Pesan</label>
                <textarea name="pesan" id="pesan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" rows="4" placeholder="Tulis pesan di sini...">{{ old('pesan', $proposal->pesan) }}</textarea>
                @error('pesan')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-500 text-white font-semibold rounded-lg shadow-md hover:from-blue-500 hover:to-indigo-400 transition duration-300">
                    <i class="fas fa-save"></i> Update Proposal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection