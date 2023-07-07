<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rembes extends Model
{
    use HasFactory;

    protected $table = 'rembes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_karyawan',
        'nominal',
        'bukti_nota',
        'created_at',
        'updated_at'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}