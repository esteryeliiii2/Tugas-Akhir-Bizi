<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    protected $table = 'perizinan';
    protected $fillable = [
        'user_id',
        'nama',
        'nis',
        'no_presensi',
        'jam_mulai',
        'jam_selesai',
        'kembali_lagi',
        'approver_umum',
        'approver_bk',
        'status',
        'kelas',
        'jurusan',
        'penginput',
        'keperluan',
        'approver_umum_id',
        'approver_bk_id',
        'alasan_reject',
        'token'
    ];

    protected $casts = [
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
    ];
}
