<?php

namespace App\Models\Inspector\CartonAudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\CLFB\Content as CLFBContent;
use Illuminate\Support\Str;
use App\Models\Configure\CLFB\Option;

class Detail extends Model
{
    use HasFactory;
    public $table="ctn_audit_detail";
    protected $fillable = ['clfb_template_content_id','ctn_audit_header_id','value'];
    public $appends = ['actualValue'];

    public function template(){
        return $this->belongsTo(CLFBContent::class,'clfb_template_content_id');
    }
    public function getActualValueAttribute(){
        $value = ($this->attributes['value'])? Str::of($this->attributes['value'])->explode(',') : 'N/A';
        //$option = $this->load('template')->optionalList;
        //$final = ($option)? $option->whereIn('id',$value) : $value;
        
        return $value ;
    }
    
}
