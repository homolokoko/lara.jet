<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarmentTracking extends Model
{
    use HasFactory;

    protected $table = 'garment_tracking';
    protected $fillable = ['garmentQrCode','bin_tickets_id'];

    public function scopeGarmentCode($q,$code)
    {
        return $q->where('garmentQrCode',$code);
    }
}
