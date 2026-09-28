<?php

namespace App\Models\Configure\CartonAudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RequiredGarment extends Model
{
    use HasFactory;
    protected $fillable = ['styles_id','purchase_order_id','amount','is_percentage'];
    protected $table="carton_audit_required_garment";
    public $timestamps = false;
    protected $appends = ['display'];

    function getIsPercentageAttribute($v){
        if($v === 1) { return 'percentage'; }
        if($v === 0) { return 'pcs'; }
    }

    function getDisplayAttribute(){
        if($this->amount !== 0 ){
            $symbol = ($this->is_percentage === 'percentage')? '%' : ' pcs';
            return Str::of(number_format($this->amount))->append($symbol)->__toString();
        }
        return 'N/A';
    }

}
