<?php

namespace App\Models\Configure\PSC;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Section extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    protected $table = 'psc_section';
    protected $fillable = [
        'name', 'psc_list_id'
    ];
    protected $translationForeignKey = 'section_id';
    public $translatedAttributes = ['translated'];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->version = $model->getMaxVersion() + 1;
        });

        static::updating(function ($model) {
            $model->version += 1;
        });
    }
    public function list()
    {
        return $this->belongsTo(Listed::class, 'psc_list_id');
    }

    public function scopeFilterDeleted($query, $value)
    {
        return ($value == 'Yes') ? $query->whereNotNull('deleted_at') : $query->whereNull('deleted_at');
    }

    public function getNameAttribute($v)
    {
        return $this->readableName($v, true);
    }
    public function scopeName($q, $v)
    {
        $v = $this->readableName($v, false);
        return $q->where(['name' => $v]);
    }

    private function readableName($name, $readable = true)
    {
        if ($readable) {
            return  Str::of($name)->snake()->replace('_', ' ')->title();
        } else {
            $name = preg_replace('/\s+/', ' ', trim($name));
            return Str::of($name)->trim()->lower()->snake();
        }
    }
    // Helper method to get the maximum version
    private function getMaxVersion()
    {
        return self::max('version') ?? 0;
    }
}
