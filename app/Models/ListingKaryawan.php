<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingKaryawan extends Model
{
    use HasFactory;

    protected $table = 'listing_karyawan';

    protected $fillable = [
        'id_pengajuan_penggajian',
        'id_karyawan',
        'gaji_pokok',
        'nominal_hutang',
        'nominal_rembes',
        'nominal_transport'
    ];
}
