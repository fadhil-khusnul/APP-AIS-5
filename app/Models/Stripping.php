<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stripping extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function stuffings(){
        return $this->belongsTo(Stuffing::class, 'id', 'id');


    }

}
