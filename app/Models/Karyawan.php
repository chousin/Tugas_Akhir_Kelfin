<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = [
        'id_user',
        'nama_karyawan',
        'alamat',
        'tgl_lahir',
        'no_hp',
        'jenis_kelamin',
        'no_rekening',
        'no_ktp',
        'created_at',
        'updated_at',
        'status_pernikahan'
    ];

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'id_karyawan');
    }

    public function Rembes()
    {
        return $this->hasMany(Rembes::class, 'id_karyawan');
    }

    public function Transport()
    {
        return $this->hasMany(Transport::class, 'id_karyawan');
    }

    public function Hutang()
    {
        return $this->hasMany(Hutang::class, 'id_karyawan');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id_karyawan');
    }

    public function listing_karyawan()
    {
        return $this->hasMany(ListingKaryawan::class, 'id_karyawan');
    }



}