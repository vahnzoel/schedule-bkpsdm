<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $connection = 'bkpsdm';
    protected $table = 'bidang';
    protected $fillable = [
        'nama',
        'singkatan',
        'color',
        'ket',
        'user_id'
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('nama', 'like', "%{$value}%")
            ->orWhere('singkatan', 'like', "%{$value}%")
            ->orWhere('ket', 'like', "%{$value}%");
    }
}
