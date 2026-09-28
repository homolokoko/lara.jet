<?php

namespace App\Models\Configure\Cutting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CheckpointTranslation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table="cutting_checkpoint_translations";
    protected $fillable = ['name'];

   
}
