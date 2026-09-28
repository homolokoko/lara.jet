<?php

namespace App\Models\Inspector\Accessory;

use App\Models\Configure\Accessory\TrimType;
use App\Models\Configure\Defects;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defect extends Model
{
    use HasFactory;
    protected $fillable = [
        'accessory_header_id', 'defect_id', 'trim_type_id', 
        'is_resolved', 'action_by','inspector_id','qty']; 
    public $table="accessory_defect";
    protected $sequences = ['no'];

    public function image(){
        return $this->hasMany(DefectImage::class, 'accessory_defect_id');
    }
    public function defect(){
        return $this->belongsTo(Defects::class,'defect_id');
    }
    public function trimType(){
        return $this->belongsTo(TrimType::class,'trim_type_id');
    }
    public function inspector(){
        return $this->belongsTo(User::class,'inspector_id');
    }
    public function recap(){
         return $this->hasMany(Comment::class, 'accessory_defect_id');
    }
    public function scopeResolved($q){
        return $q->where(['is_resolved'=>0]);
    }

}
