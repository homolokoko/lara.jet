<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binticket extends Model
{
    use HasFactory;

    protected $table = 'bin_tickets';
    protected $fillable = ['number'];
}
