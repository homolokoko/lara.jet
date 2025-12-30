<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'users';
    protected $fillable = ['name','email'];

    public function staff()
    {
        return $this
            ->hasOne(\App\Models\Staff::class,'user_id');
    }

    public function position()
    {
        return $this
            ->hasOne(Position::class,'user_id');
    }


    public function addresses()
    {
        return $this
            ->hasMany(Address::class,'user_id');
    }

    public function parentCareer()
    {
        return $this
            ->hasOne(ParentCareer::class,'user_id');
    }

    public function phoneNumbers()
    {
        return $this
            ->hasMany(PhoneNumber::class,'user_id');
    }

    public function photograph()
    {
        return $this
            ->hasOne(Photograph::class,'user_id');
    }

}
