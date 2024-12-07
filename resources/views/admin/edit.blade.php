@extends('layouts.app')

@section('title', 'Edit Proposal')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Judul Halaman -->
        <h1 class="text-4xl font-semibold text-center text-blue-600 mb-6">Edit Proposal</h1>

        <!-- Form Edit Proposal -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('admin.proposal.update', $proposal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-semibold">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $proposal->nama) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required readonly>
                    @error('nama')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NPM -->
                <div class="mb-4">
                    <label for="npm" class="block text-gray-700 font-semibold">NPM</label>
                    <input type="text" name="npm" id="npm" value="{{ old('npm', $proposal->npm) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required readonly>
                    @error('npm')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Judul Proposal -->
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-semibold">Judul Proposal</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $proposal->judul) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required readonly>
                    @error('judul')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Pilih Dosen -->
                <select name="dospem" id="dosen" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->id }}" {{ old('dospem', $proposal->dospem) == $d->id ? 'selected' : '' }}>
                            {{ $d->nama }}
                        </option>
                    @endforeach
                </select>

                <!-- Status Proposal -->
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold">Status Proposal</label>
                    <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                        <option value="Menunggu" {{ old('status', $proposal->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diterima" {{ old('status', $proposal->status) == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Revisi" {{ old('status', $proposal->status) == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                    </select>
                    @error('status')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Pesan untuk Mahasiswa -->
                <div class="mb-4">
                    <label for="pesan" class="block text-gray-700 font-semibold">Pesan</label>
                    <textarea name="pesan" id="pesan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" rows="4">{{ old('pesan', $proposal->pesan) }}</textarea>
                    @error('pesan')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="mb-4 text-center">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Update Proposal</button>
                </div>
            </form>
        </div>
    </div>
@endsection