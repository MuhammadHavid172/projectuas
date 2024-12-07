<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('npm');
            $table->string('judul');
            $table->unsignedBigInteger('dospem_id')->nullable();
            $table->enum('status', ['Menunggu', 'Diterima', 'Revisi'])->default('Menunggu');
            $table->text('pesan')->nullable();
            $table->string('file_proposal')->nullable();
            $table->timestamps();

            $table->foreign('dospem_id')->references('id')->on('dosen')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
