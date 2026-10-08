<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Vicklr\MaterializedModel\MaterializedModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends MaterializedModel
{
    use HasFactory;
    use SoftDeletes;
    use HasRoles;
    protected string $orderColumn = 'weight';

    protected $table = 'users';
    protected $fillable = ['name','email','password','parent_id','locale'];
    protected $appends = ['children','isRoot','join'];

    public function staff()
    {
        return $this
            ->hasOne(\App\Models\Staff::class,'user_id');
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

    public function getJoinAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('F jS, Y');
    }

    public function getIsRootAttribute()
    {
        return $this->isRoot();
    }

    public function getChildrenAttribute()
    {
        return $this->children()->get();
    }
}
