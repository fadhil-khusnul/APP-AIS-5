<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function pelayaran(){
        return $this->belongsTo(ShippingCompany::class, 'pelayaran_id', 'id');
    }
}
