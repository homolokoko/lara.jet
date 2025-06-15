<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StyleProfile extends Model
{
    use HasFactory;
    protected $table = 'style_profile';

    public function style()
    {
        return $this
            ->belongsTo(
                Style::class,
                'style_id'
            );
    }
}
