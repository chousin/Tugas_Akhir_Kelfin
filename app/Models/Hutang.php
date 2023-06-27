<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;

    protected $table = 'hutang';

    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'id_karyawan',
        'nominal_hutang',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}