<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
    'mata_kuliah', 'dosen', 'ruangan', 'hari', 'jam_mulai', 'jam_selesai', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
