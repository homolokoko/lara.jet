<?php

namespace App\Models\Inspector\ProductDevelopment\Record\Error;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;
    public $table = 'develop_product_record_remark';
    protected $fillable = ['remark', 'editor_id'];
}
