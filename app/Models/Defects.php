<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defects extends Model
{
    use HasFactory;

    protected $table = 'defects';

    public function translations()
    {
        return $this
            ->hasMany(
                DefectsTranslations::class,
                'defects_id'
            );
    }
}
