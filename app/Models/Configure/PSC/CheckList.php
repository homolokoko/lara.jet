<?php

namespace App\Models\Configure\PSC;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CheckList extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    protected $table = 'psc_checkpoint';
    protected $fillable = [
        'readable_name',
    ];
    protected $translationForeignKey = 'checkpoint_id';
    public $translatedAttributes = ['translated'];

    public function scopeFilterDeleted($query, $value)
    {
        return ($value == 'Yes') ? $query->whereNotNull('deleted_at') : $query->whereNull('deleted_at');
    }

    public function getReadableNameAttribute($v)
    {
        return Str::of($v)->snake()->replace('_', ' ')->title();
    }
}
