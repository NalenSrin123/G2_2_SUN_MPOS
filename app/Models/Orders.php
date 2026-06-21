<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'table_number',
        'total_price',
        't_id',
    ];
    //belong to name_table
    public function name_table(){
        return $this->belongsTo(name_table::class,'t_id', 't_id');
    }
}
