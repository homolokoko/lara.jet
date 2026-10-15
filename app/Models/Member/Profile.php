<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vicklr\MaterializedModel\MaterializedModel;

class Profile extends MaterializedModel
{
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
}
