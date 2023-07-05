<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPenggajian extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_penggajian';

    protected $fillable = [
        'id_user',
        'periode_start',
        'periode_end',
        'keterangan',
        'status_pengajuan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
