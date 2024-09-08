<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primarykey = 'id';

    protected $fillable = [
        'catalog_id',
        'name',
        'description',
        'bulk_unit_price',
        'unit_price',
        'percent_off',
        'offer',
        'price_offer',
        'stock',
        'image_url',
        'category_id',
        'type_id',
    ];
}
