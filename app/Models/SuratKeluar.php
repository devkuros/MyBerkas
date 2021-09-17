<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class SuratKeluar extends Model
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $table = 'surat_keluars';

    protected $fillable = [
        'nosurat',
        'perihal',
        'kategori_surat',
        'keterangan',
        'files',
        'devisi',
        'tgl_surat_keluar',
    ];

    protected $dates = [];
}
