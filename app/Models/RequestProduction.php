<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestProduction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id", "product_id", "request_quantity", "actual_quantity", "status"
    ];
}
