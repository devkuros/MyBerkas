<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Spatie\Permission\Traits\HasRoles;

class FormatSurat extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $table = "format_surats";

    protected $fillable = [
        'kode_format',
        'nama_format',
        'file_format',
        'url_format'
    ];

    public function templateSurat(){
        return $this->hasMany(TemplateSurat::class, 'format_surat_id');
    }
}
