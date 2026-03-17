<?php

namespace App\Models\Configure\Accessory;

use App\Models\Configure\Defects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrimTypeDefect extends Model
{
    use HasFactory;
    protected $table='trim_type_defect';
    public function defect(){
        return $this->belongsTo(Defects::class,'defects_id');
    }
}
