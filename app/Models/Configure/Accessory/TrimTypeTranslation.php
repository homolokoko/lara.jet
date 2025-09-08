<?php

namespace App\Models\Configure\Accessory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrimTypeTranslation extends Model
{
    use HasFactory;
    protected $table="trim_type_translation";
    protected $fillable = ['name'];
}
