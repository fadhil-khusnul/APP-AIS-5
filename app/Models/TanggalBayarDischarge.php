<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggalBayarDischarge extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function invoices(){
        return $this->belongsTo(InvoceDischarge::class, 'invoice_id', 'id');
    }
}
