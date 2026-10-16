<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vicklr\MaterializedModel\MaterializedModel;
use Spatie\Permission\Traits\HasRoles;

class Profile extends MaterializedModel
{
    use HasRoles;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'users';
    protected $fillable = ['name','locale','email','password'];
    protected string $orderColumn = 'weight';
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];
    protected $appends = ['isRoot'];

    public function getChildrenAttribute()
    {
        return $this->children()->get();
    }
    public function getIsRootAttribute()
    {
        return $this->isRoot();
    }

    public function detail()
    {
        return $this->hasOne(Detail::class, 'user_id');
    }

    public function photograph()
    {
        return $this->hasOne(Photograph::class,'user_id');
    }

    public function phonenumbers()
    {
        return $this->hasMany(Phonenumber::class,'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class,'user_id');
    }

    public function relatives()
    {
        return $this->hasMany(Relative::class,'user_id');
    }

}
