<?php


namespace Modules\Category\TraitClass;

use Modules\Category\Entities\Models\Categorizable;
use Modules\Category\Entities\Models\Category;

trait CategorizableTrait
{

    /**
     * Get all category.
     *
     * @return Category
     */
    public static function getCategories()
    {
        /** @var Category $category */
        $category = Category::get();

        return $category;
    }

    /**
     * Get selected category by id.
     *
     * @param $id
     */
    public static function getById($id)
    {
        /** @var Category $category */
        $category = Category::find($id);

        if(!($category instanceof Category)) return false;

        return $category;
    }

    /**
     * Categorized post.
     *
     * @param array $array
     * @return bool|string
     */
    public static function createCategorizable(array $array)
    {
        try {

            Categorizable::insert($array);

        } catch ( \Illuminate\Database\QueryException $exception ) {

            return $exception->getMessage();
        }

        return true;
    }

}