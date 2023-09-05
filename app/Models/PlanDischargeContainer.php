<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDischargeContainer extends Model
{
    use HasFactory;
    protected $guarded = [""];

    public function mobils()
    {
        return $this->belongsTo(SupirMobil::class, 'driver', 'id');
    }

}
