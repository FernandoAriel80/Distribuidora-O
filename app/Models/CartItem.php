<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Cart::class);
    }

    protected $table = 'cart_items';
    protected $primarykey = 'id';

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
    ];

}
