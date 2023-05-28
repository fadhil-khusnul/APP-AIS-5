<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlihKapal extends Model
{
    use HasFactory;
    protected $guarded = [''];



    public function container_planloads(){
        return $this->belongsTo(ContainerPlanload::class, 'kontainer_alih', 'id');
    }
    public function jobs(){
        return $this->belongsTo(OrderJobPlanload::class, 'job_id', 'id');
    }



}
