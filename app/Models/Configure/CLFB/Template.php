<?php

namespace App\Models\Configure\CLFB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $table='clfb_template';
    protected $fillable = ['name','clfb_type_id'];
    protected $hidden = ['clfb_type_id','created_at','updated_at'];
    public function content(){
        return $this->hasMany(Content::class,'clfb_template_id');
    }
    
}
