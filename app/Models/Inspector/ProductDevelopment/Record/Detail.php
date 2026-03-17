<?php

namespace App\Models\Inspector\ProductDevelopment\Record;

use App\Models\Configure\ProductDevelop\CheckList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    public $table = 'develop_product_record_detail';
    protected $fillable = ['header_id', 'check_list_id', 'status'];

    function checkList()
    {
        return $this->belongsTo(CheckList::class, 'check_list_id');
    }
    function errorImage()
    {
        return $this->hasMany(Error\Image::class, 'detail_id');
    }
    function errorRemark()
    {
        return $this->hasMany(Error\Remark::class, 'detail_id');
    }
    function getStatusAttribute($v)
    {
        if ($v === -1) {
            return 'skip';
        }
        if ($v == 1) {
            return 'pass';
        }
        if ($v == 0) {
            return 'fail';
        }
    }
}
