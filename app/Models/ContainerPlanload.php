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

    public function si_pdf_containers()
    {
        return $this->belongsTo(SiPdfContainer::class, 'slug', 'container_id')->withDefault([
            'nomor_bl' => ' ',

        ]);
    }
    public function alihs()
    {
        return $this->belongsTo(AlihKapal::class, 'harga_alih', 'id');
    }
   
    public function invoices()
    {
        return $this->belongsTo(InvoiceLoad::class, 'status_invoice', 'nomor_invoice')->withDefault([
            'tanggal_invoice' => ' ',

        ]);
    }
    public function mobils(){
        return $this->belongsTo(SupirMobil::class, 'nomor_polisi', 'id')->withDefault([
            'nomor_polisi' => ' ',
        ]);
    }
    public function danas()
    {
        return $this->belongsTo(OngkoSupir::class, 'dana', 'id')->withDefault([
            'pj' => ' ',

        ]);
    }


}
