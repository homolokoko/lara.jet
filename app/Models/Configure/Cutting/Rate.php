<?php

namespace App\Models\Configure\Cutting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $fillable = ['styles_id','fail_rate','cabin_audit_rate'];
    protected $table="styles_cutting_rate";
    public $timestamps = false;

    public function styles(){
        $this->belongsTo(Styles::class,'styles_id');
    }
}
