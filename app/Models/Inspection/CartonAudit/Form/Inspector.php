<?php

namespace App\Models\Inspector\CartonAudit\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    use HasFactory;
    public $table="carton_audit_form_inspector";
    protected $fillable = ['carton_audit_form_header_id','inspector_id','passed_pcs','failed_pcs'];
}
