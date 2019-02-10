<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Models\Category;
use Modules\Category\TraitClass\CategorizableTrait;

class CategoryController extends Controller
{
    use CategorizableTrait;

    /**
     * @return Response
     */
    public function index()
    {
        return view('category::index')->with('categories', CategorizableTrait::getCategories() );
    }

    /**
     * @param $id
     */
    public function getById($id)
    {
        /** @var CategorizableTrait $category */
        $category = CategorizableTrait::getById($id);

        if($category === false)
        {
            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => 'Category not found.'
            ]);
        }

        return view('category::categorized-posts')->with('category', $category);
    }

    /**
     * @return Response
     */
    public function create(Request $request)
    {
        /**  Validate category information. */
        $validator = validator( $request->all(),
            [
                'title' => 'required|string|max:128',
                'type'  => 'required|string|in:parent,child'
            ]
        );

        if ( $validator->fails() ) {

            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => $validator->errors()->first()
            ]);

        }

        switch ( $request->get('type') )
        {
            case Category::TYPE_PARENT:

                /** Save parent category. */
                try {

                    Category::create([

                        'title' => $request->get( 'title' ),
                        'type'  => Category::TYPE_PARENT

                    ]);

                } catch ( \Illuminate\Database\QueryException $exception ) {

                    return response()->json([
                        'status'  => 'error',
                        'title'   => 'Something wrong!',
                        'content' => $exception->getMessage()
                    ]);
                }


            break;

            default:

                /** @var Category $parent */
                $parent = Category::find( $request->get('parent_id') );

                if ( null === $parent ) {

                    return response()->json([
                        'status'  => 'error',
                        'title'   => 'Something wrong!',
                        'content' => 'Parent category not found.'
                    ]);
                }

                /** Save sub category. */
                try {

                    Category::create([

                        'title' => $request->get( 'title' ),
                        'type'  => Category::TYPE_CHILD,
                        'parent_id' => $request->get('parent_id')

                    ]);

                } catch ( \Illuminate\Database\QueryException $exception ) {

                    return response()->json([
                        'status'  => 'error',
                        'title'   => 'Something wrong!',
                        'content' => $exception->getMessage()
                    ]);
                }

            break;

        }



        return response()->json([
            'status'  => 'success',
            'title'   => 'Success!',
            'content' => 'Category saved.'
        ]);

    }
}
