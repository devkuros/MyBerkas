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
        'nama_surat',
        'slug_template',
        'url_format',
        'ket_template'
    ];

    public function formatSurat(){
        return $this->belongsTo(FormatSurat::class);
    }
}
