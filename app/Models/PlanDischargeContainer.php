<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDischargeContainer extends Model
{
    use HasFactory;
    protected $guarded = [""];

    public function mobils()
    {
        return $this->belongsTo(SupirMobil::class, 'driver', 'id');
    }

    public function invoices()
    {
        return $this->belongsTo(InvoiceDischarge::class, 'status_invoice', 'nomor_invoice')->withDefault([
            'tanggal_invoice' => ' ',

        ]);
    }



}
