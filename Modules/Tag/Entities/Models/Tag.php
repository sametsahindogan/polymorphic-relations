<?php

namespace Modules\Tag\Entities\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @var string $table */
    protected $table = 'tags';

    /** @var array $fillable */
    protected $fillable = [
        'title'
    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
