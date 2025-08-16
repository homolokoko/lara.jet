<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseTranslation extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "defects_cause_translations";
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
