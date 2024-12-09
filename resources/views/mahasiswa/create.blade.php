@extends('layouts.app')
@section('title', 'Pendaftaran Proposal')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-3xl font-bold mb-5">Pendaftaran Proposal</h1>

    <form action="{{ url('/mahasiswa') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" required>
            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- NPM -->
        <div class="mb-4">
            <label for="npm" class="form-label">NPM</label>
            <input type="text" id="npm" name="npm" class="form-control" value="{{ old('npm') }}" required>
            @error('npm')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Judul Proposal -->
        <div class="mb-4">
            <label for="judul" class="form-label">Judul Proposal</label>
            <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul') }}" required>
            @error('judul')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- File Proposal -->
        <div class="mb-4">
            <label for="file_proposal" class="form-label">Unggah File Proposal (Word)</label>
            <input type="file" id="file_proposal" name="file_proposal" class="form-control" accept=".doc,.docx" required>
            @error('file_proposal')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Ajukan Proposal</button>
        </div>
    </form>
</div>

<!-- SweetAlert untuk pesan -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{session('
        success ')}}',
        confirmButtonText: 'OK'
    });
    @elseif(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('
        error ') }}',
        confirmButtonText: 'OK'
    });
    @endif
</script>

@endsection