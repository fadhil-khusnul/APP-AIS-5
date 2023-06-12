<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depo extends Model
{
    use HasFactory;

    protected $guarded = [''];


    public function pelabuhans(){
        return $this->belongsTo(ShippingCompany::class, 'vendor_id', 'id')->withDefault([
            'nama_company' => ' ',
        ]);
    }



}
