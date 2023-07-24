<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitySecond extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function province():BelongsTo
    {
        return $this->belongsTo(ProvinceSecond::class);
    }
}
