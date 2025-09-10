<?php

namespace App\Models\Inspector\Inline;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    public $table='insp_inline_operator';
    protected $fillable = ['insp_inline_profile_id','operator_id'];
    public $timestamps = false;

    public function name(){
        return $this->belongsTo(User::class,'operator_id');
    }
    public function inlineprofile(){
        return $this->belongsTo(Profile::class,'insp_inline_profile_id');
    }

}
