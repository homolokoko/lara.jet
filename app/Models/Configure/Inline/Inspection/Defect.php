<?php

namespace App\Models\Configure\Inline\Inspection;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Defect extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $primaryKey = 'id';
    protected $appends = ['name'];
    protected $table = 'inline_inspection_defect';
    protected $translatedAttributes = ['translated'];
    protected $translationForeignKey = 'inline_inspection_defect_id';

    function getNameAttribute(){
        return ucwords(str_replace('_',' ',$this->translated));
    }


}
