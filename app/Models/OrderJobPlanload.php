<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderJobPlanload extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function container_planloads()
    {
        return $this->hasMany(ContainerPlanload::class, 'job_id', 'id');
    }


}
