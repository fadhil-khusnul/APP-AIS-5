<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupirMobil extends Model
{
    use HasFactory;
    protected $guarded = [''];



    public function vendors(){
        return $this->belongsTo(VendorMobil::class, 'vendor_id', 'id')->withDefault([
            'nama_vendor' => ' ',
        ]);
    }

}
