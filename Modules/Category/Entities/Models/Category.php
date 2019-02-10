<?php

namespace Modules\Category\Entities\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @var string $table */
    protected $table = 'categories';

    /** @var array $fillable */
    protected $fillable = [
        'title',
        'type',
        'parent_id'
    ];

    /* Category types. */
    public const TYPE_PARENT = 'parent';
    public const TYPE_CHILD = 'child';

    /* Array of types. */
    public const CATEGORY_TYPES = [

        self::TYPE_PARENT,
        self::TYPE_CHILD,

    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorizable');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id','id');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id','id');
    }
}
