<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'name',
        'price_usd',
        'quantity',
        'cat_id',
    ];
    //menu belong to category
    public function category(){
        return $this->belongsTo(categories::class,'cat_id', 'cat_id');
    }
}
