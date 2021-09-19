<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Spatie\Permission\Traits\HasRoles;

class TemplateSurat extends Model
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $table = "template_surats";

    protected $fillable = [
        'kode_template',
        'nama_surat',
        'slug_template',
        'file_template',
        'ket_template'
    ];
}
