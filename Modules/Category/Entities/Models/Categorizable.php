<?php

namespace Modules\Category\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Categorizable extends Model
{
    /** @var string $table */
    protected $table = 'categorizables';

    /** @var array $fillable */
    protected $fillable = [
        'category_id',
        'categorizable_id',
        'categorizable_type',
        'created_at',
        'updated_at'
    ];
}
