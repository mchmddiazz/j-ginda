<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maize\Markable\Markable;
use Maize\Markable\Models\Favorite;
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static $marks = [
        Favorite::class,
    ];
}
