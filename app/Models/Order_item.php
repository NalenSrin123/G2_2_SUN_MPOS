<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $table = "order_items";
    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
    ];
    // Each item belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    // Each item belongs to a menu item
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
}
