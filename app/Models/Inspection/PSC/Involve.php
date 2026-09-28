<?php

namespace App\Models\Inspector\PSC;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Involve extends Model
{
    use HasFactory;
    protected $table = 'psc_record_involve';
    protected $fillable = [
        'profile_id','inspector_id'
    ];

    function inspector(){
        return $this->belongsTo( User::class, 'inspector_id');
    }
}
