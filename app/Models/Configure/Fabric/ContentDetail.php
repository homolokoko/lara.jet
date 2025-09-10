<?php

namespace App\Models\Configure\Fabric;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'fabric_contents_detail';
    protected $fillable = [
        'percent','content_id'
    ];


    public function getContent(){
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }


}
