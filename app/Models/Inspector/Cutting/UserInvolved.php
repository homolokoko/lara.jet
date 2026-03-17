<?php

namespace App\Models\Inspector\Cutting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvolved extends Model
{
    use HasFactory;
    protected $table = 'cutting_involve';
    protected $fillable = ['inspector_id','header_id','last_activity'];
    public $timestamps = false;

    function inspector(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

}
