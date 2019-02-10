<?php

namespace Modules\Tag\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{

    /** @var string $table */
    protected $table = 'taggables';

    /** @var array $fillable */
    protected $fillable = [
        'tag_id',
        'taggable_id',
        'taggable_type',
        'created_at',
        'updated_at'
    ];

}
