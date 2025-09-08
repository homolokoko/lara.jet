<?php

namespace App\Models\Configure\Cutting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="cutting_panel_translations";
    protected $fillable = ['name'];
   
}
