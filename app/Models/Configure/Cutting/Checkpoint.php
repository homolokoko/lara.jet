<?php

namespace App\Models\Configure\Cutting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Checkpoint extends Model implements TranslatableContract
{
    
    use HasFactory;
    use Translatable;

    protected $table='cutting_checkpoint';
    public $translatedAttributes = ['name'];

    public function scopeChecklist($q){
        return $q->where(['show_checklist'=>1]);
    }
    public function scopeBindAudit($q){
        return $q->where(['show_binaudit'=>1]);
    }
    public function scopePrint($q){
        return $q->where(['is_fabric_print'=>1]);
    }
    public function scopeStripe($q){
        return $q->where(['is_fabric_stripe'=>1]);
    }
    public function scopeSolid($q){
        return $q->where(['is_fabric_solid'=>1]);
    }
    public function scopeStripeAndPrint($q){
        return $q->whereOr(['is_fabric_print'=>1,'is_fabric_stripe'=>1]);

    }
   
}
