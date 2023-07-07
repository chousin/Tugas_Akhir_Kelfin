<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $table = 'transport';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_karyawan',
        'jenis_bensin_produk',
        'liter_volume',
        'harga_liter',
        'bukti_struk',
        'created_at',
        'updated_at'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

}