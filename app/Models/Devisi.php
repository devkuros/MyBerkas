<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Devisi extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'devisis';

    protected $fillable = [
        'name_devisi'
    ];
}
