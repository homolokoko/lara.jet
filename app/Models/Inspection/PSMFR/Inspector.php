<?php

namespace App\Models\Inspector\PSMFR;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    use HasFactory;
    protected $table = 'psmfr_inspector';
    protected $fillable = ['inspector_id'];

    function info(){
        return $this->belongsTo(User::class,'inspector_id');
    }
}
