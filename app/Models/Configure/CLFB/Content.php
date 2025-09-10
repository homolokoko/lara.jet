<?php

namespace App\Models\Configure\CLFB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Configure\CLFB\Option;
use App\Models\Inspector\CartonAudit\Header as CartonAudit;

class Content extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='clfb_template_content';
    protected $fillable = ['id','clfb_template_id','clfb_input_type_id','label','desc','order','is_required'];
   // protected $appends = ['optionalList'];
    private $tmp;

    public function input(){
        return $this->belongsTo(InputType::class,'clfb_input_type_id');
    }
    public function getIsRequiredAttribute(){
        $val = ($this->attributes['is_required'])? 'required' : '';
        return $val ;
    }
    
    public function cartonAudit(){
        return $this->hasMany(CartonAudit::class, 'clfb_template_id');
    }

    public function optionTranslate(){
        $option = null;
        if($this->tmp){
            $option = Option::with('translations')->whereIN('id',$this->tmp)->get();
            $option = collect($option)->transform(function($i,$k){
                return [ 'id'=>$i['id'] ,'name'=>$i['name'] ]; 
            });
            return $option;
        }
        return $option;
    }
    public function getOptionalListAttribute(){
        $val  = null;
        if(in_array($this->attributes['clfb_input_type_id'], array(1,9,10))){
            $option = Str::of($this->attributes['desc'])->explode(',');
            $this->tmp = $option;
            $option = $this->optionTranslate();
            return  $option;
        }
        return $val ;
    }
}
