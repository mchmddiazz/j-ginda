<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kavist\RajaOngkir\Resources\Provinsi;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province():BelongsTo
    {
        return $this->belongsTo(ProvinceSecond::class);
    }

    /**
     * @return BelongsTo
     */
    public function city():BelongsTo
    {
        return $this->belongsTo(CitySecond::class, "regency_id");
    }
}
