<?php

// app/Models/JurusanProposal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'nama',
        'npm',
        'judul',
        'dospem_id',
        'status',
    ];

    // Relasi ke Proposal
    // public function proposal()
    // {
    //     return $this->belongsTo(Proposal::class, 'proposal_id');
    // }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
