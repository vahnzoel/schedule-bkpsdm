<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $connection = 'bkpsdm';
    protected $table = 'agenda';
    protected $fillable = [
        'judul',
        'tgl',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'bidang',
        'peserta',
        'ket',
        'user_id',
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('judul', 'like', "%{$value}%")
            ->orWhere('lokasi', 'like', "%{$value}%")
            ->orWhere('bidang', 'like', "%{$value}%")
            ->orWhere('peserta', 'like', "%{$value}%")
            ->orWhere('tgl', 'like', "%{$value}%");
    }
}
