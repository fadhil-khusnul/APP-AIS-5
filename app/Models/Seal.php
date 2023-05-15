<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seal extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function container_planloads(){
        return $this->belongsTo(ContainerPlanload::class, 'kode_seal', 'seal');
    }





}
