<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = [
        'productName',
        'catId',
        'slug',
        'brandId',
        'detail',
        'price',
        'salePrice',
        'image',
        'status'
    ];
}
