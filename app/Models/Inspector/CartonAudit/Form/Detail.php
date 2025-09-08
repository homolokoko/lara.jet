<?php

namespace App\Models\Inspector\CartonAudit\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    public $table = "carton_audit_form_detail";
    protected $fillable = ['carton_audit_form_header_id', 'is_pass'];

    public function header()
    {
        return $this->belongsTo(Header::class, 'carton_audit_form_header_id');
    }
    public function defect()
    {
        return $this->hasMany(Defect::class, 'carton_audit_form_detail_id');
    }
}
