<?php

namespace App\Models\Vlookups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'vlookups_table';
    protected $fillable = [''];
}
