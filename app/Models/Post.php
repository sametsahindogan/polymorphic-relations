<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Models\Category;
use Modules\Tag\Entities\Models\Tag;

class Post extends Model
{

    /** @var string $table */
    protected $table = 'posts';

    /** @var array $fillable */
    protected $fillable = [
        'content'
    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

}
