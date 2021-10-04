<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pejabat extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function jabatan(){
        return $this->hasOne(Jabatan::class);
    }
}
