<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiPdfContainer extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function containers(){
        return $this->belongsTo(ContainerPlanload::class, 'container_id', 'slug');
    }



}
