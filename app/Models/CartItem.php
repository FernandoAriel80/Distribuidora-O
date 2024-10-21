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
        'catalog_id',
        'name',
        'cuantity',
        'price',
        'url_image',
        'cart_id',
    ];

}
