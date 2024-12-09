<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jurusan_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id');  // Menambahkan kolom proposal_id
            $table->string('nama');
            $table->string('npm');
            $table->string('judul');
            $table->string('file_proposal');
            $table->unsignedBigInteger('dospem_id')->nullable();  // Menambahkan nullable
            $table->enum('status', ['Menunggu', 'Diterima', 'Revisi']);
            $table->timestamps();

            $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade'); // Menambahkan foreign key untuk proposal_id
            $table->foreign('dospem_id')->references('id')->on('dosen')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan_proposals');
    }
};
