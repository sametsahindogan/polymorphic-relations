<?php

namespace Modules\Tag\TraitClass;

use Modules\Tag\Entities\Models\Tag;
use Modules\Tag\Entities\Models\Taggable;

trait TaggableTrait
{
    /**
     * Get all tags.
     *
     * @return Tag
     */
    public static function getTags()
    {
        /** @var Tag $tags */
        $tags = Tag::get();

        return $tags;
    }

    /**
     * Get selected tag by id.
     *
     * @param $id
     */
    public static function getById($id)
    {
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if(!($tag instanceof Tag)) return false;

        return $tag;
    }

    /**
     * Tagged post.
     *
     * @param array $array
     * @return bool|string
     */
    public static function createTaggable(array $array)
    {
        try {

            Taggable::insert($array);

        } catch ( \Illuminate\Database\QueryException $exception ) {

           return $exception->getMessage();
        }

        return true;
    }

}