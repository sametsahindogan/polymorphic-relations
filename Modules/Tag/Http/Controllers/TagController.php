<?php

namespace Modules\Tag\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Tag\Entities\Models\Tag;
use Modules\Tag\TraitClass\TaggableTrait;

class TagController extends Controller
{
    use TaggableTrait;
    /**
     * @return Response
     */
    public function index()
    {
        return view('tag::index')->with('tags', TaggableTrait::getTags() );
    }

    /**
     * @param $id
     */
    public function getById($id)
    {
        $tag = TaggableTrait::getById($id);

        if($tag === false)
        {
            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => 'Tag not found.'
            ]);
        }

        return view('tag::tagged-posts')->with('tag', $tag);
    }

    /**
     * @return Response
     */
    public function create(Request $request)
    {
        /**  Validate tag information. */
        $validator = validator( $request->all(),
            [
                'title' => 'required|string|max:128'
            ]
        );

        if ( $validator->fails() ) {

            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => $validator->errors()->first()
            ]);

        }

        /** Save tag. */
        try {

            Tag::create([

                'title' => $request->get( 'title' ),

            ]);

        } catch ( \Illuminate\Database\QueryException $exception ) {

            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => $exception->getMessage()
            ]);
        }


        return response()->json([
            'status'  => 'success',
            'title'   => 'Success!',
            'content' => 'Tag saved.'
        ]);

    }

}
