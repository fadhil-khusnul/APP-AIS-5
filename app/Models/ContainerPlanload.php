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



    public function planload()
    {
        return $this->belongsTo(OrderJobPlanload::class, 'job_id', 'id');
    }
    public function mobils()
    {
        return $this->belongsTo(SupirMobil::class, 'nomor_polisi', 'id');
    }

}
