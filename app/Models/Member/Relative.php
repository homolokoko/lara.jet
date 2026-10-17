<?php

namespace App\Models\Member;

use App\Library\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relative extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'users_relative';
    protected $fillable = ['user_id','who_they','name','career','is_current'];

    public function phonenumbers()
    {
        return $this->hasMany(RelativePhonenumber::class,'user_relative_id');
    }

    public function getWhoTheyAttribute($value)
    {
        return [
            'value'=>$value,
            'text'=>Helper::getRelative($value)
        ];
    }
}
