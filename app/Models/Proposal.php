<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'npm',
        'judul',
        'file_proposal',
        'dospem',
        'status',
        'pesan',
    ];

    public function dospem()
    {
        return $this->belongsTo(Dosen::class, 'dospem');    
    }
}
