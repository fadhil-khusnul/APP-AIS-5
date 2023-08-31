<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SealContainer extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function container_planloads(){
        return $this->belongsTo(ContainerPlanload::class, 'kontainer_id', 'id') AND $this->belongsTo(PlanDischargeContainer::class, 'kontainer_id_discharge', 'id',);
       
    }
    // public function container_planloads_discharge(){
      
    //     return $this->belongsTo(PlanDischargeContainer::class, 'kontainer_id_discharge', 'id');
        
    // }



}
