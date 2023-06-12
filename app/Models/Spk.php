<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spk extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function spk_containers(){
        return $this->belongsTo(SpkContainer::class, 'kode_spk', 'spk_kontainer');
    }
    public function pelabuhans(){
        return $this->belongsTo(ShippingCompany::class, 'pelayaran_id', 'id')->withDefault([
            'nama_company' => ' ',

        ]);
    }




}
