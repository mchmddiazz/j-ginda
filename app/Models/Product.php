<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Markable;
use Maize\Markable\Models\Favorite;
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static $marks = [
        Favorite::class,
    ];
}
