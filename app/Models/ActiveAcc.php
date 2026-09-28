<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ActiveAcc extends Model
{
    use HasFactory;

    protected $table = 'active_acc';
    protected $hidden = ['UserPassword','sectionID','SignatureID','image'];

}
