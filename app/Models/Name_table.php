<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Name_table extends Model
{
    protected $table = "name_tables";
    protected $fillable = [
        'name',
        'status'
    ];
}
