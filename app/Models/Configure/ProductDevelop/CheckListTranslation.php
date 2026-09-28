<?php

namespace App\Models\Configure\ProductDevelop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckListTranslation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "develop_product_checklist_translations";
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
