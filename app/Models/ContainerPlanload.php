<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContainerPlanload extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function kontainers(){
        return $this->belongsTo(Container::class, 'kontainer', 'id');
    }
  


    public function order_job_planloads()
    {
        return $this->belongsTo(OrderJobPlanload::class, 'id');
    }

}
