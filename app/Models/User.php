<?php

namespace App\Models;

use App\Models\Member\{Detail,PhoneNumber,Relative,Address,Photograph};
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Vicklr\MaterializedModel\Traits\HasMaterializedPaths;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasMaterializedPaths;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $guard_name = 'web';

    // 'parent_id' column name
    protected string $parentColumn = 'parent_id';

    // 'depth' column name
    protected string $depthColumn = 'depth';

    // 'path' column name
    protected string $pathColumn = 'path';

    // guard attributes from mass-assignment
    protected $guarded = array('id', 'parent_id', 'depth', 'path', 'weight');


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
