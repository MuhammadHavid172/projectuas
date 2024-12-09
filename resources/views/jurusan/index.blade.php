@extends('layouts.app')

@section('title', 'Data Proposal Jurusan')

@section('content')
<div class="container mx-auto p-6">
   <h1 class="text-4xl font-semibold text-center text-blue-600 mb-6">Data Proposal yang Telah Diterima</h1>

   <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
      <table class="min-w-full table-auto">
         <thead class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
            <tr>
               <th class="px-4 py-3 text-left">No</th>
               <th class="px-4 py-3 text-left">Nama</th>
               <th class="px-4 py-3 text-left">NPM</th>
               <th class="px-4 py-3 text-left">Judul</th>
               <th class="px-4 py-3 text-left">Dosen Pembimbing</th>
            </tr>
         </thead>
         <tbody>
            @if ($proposals->isEmpty())
            <tr>
               <td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada data yang diterima</td>
            </tr>
            @else
            @foreach ($proposals as $jurusanProposal)
            <tr>
               <td>{{ $jurusanProposal->proposal_id }}</td>
               <td>
                  @if ($jurusanProposal->proposal && $jurusanProposal->proposal->dospem)
                  {{ $jurusanProposal->proposal->dospem->nama }}
                  @else
                  Tidak ada dospem
                  @endif
               </td>
            </tr>
            @endforeach

            @endif
         </tbody>
      </table>
   </div>
</div>
@endsection