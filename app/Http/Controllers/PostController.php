<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\PostsInterface;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Category\TraitClass\CategorizableTrait;
use Modules\Tag\TraitClass\TaggableTrait;

class PostController extends Controller implements PostsInterface
{
    use TaggableTrait, CategorizableTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|object
     */
    public function get()
    {
        /** @var Post $posts */
        $posts = Post::with('tags', 'categories')->get();

        return view('index')->with('posts', $posts);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|object
     */
    public function getById($id)
    {
        /** @var Post $post */
        $post = Post::with('tags', 'categories')->find($id);

        /** @var TaggableTrait $tags */
        $tags  = TaggableTrait::getTags();

        /** @var CategorizableTrait $categories */
        $categories = CategorizableTrait::getCategories();

        return view('update-post')->with([
            'post' => $post,
            'tags' => $tags,
            'categories' => $categories
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function create(Request $request)
    {
        /**  Validate post information. */
        $validator = validator( $request->all(),
            [
                'content' => 'required|string|max:256',
            ]
        );

        if ( $validator->fails() ) {

            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => $validator->errors()->first()
            ]);

        }

        /** Save post. */
        try {

            Post::create([

                'content' => $request->get( 'content' ),

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
            'content' => 'Post saved.'
        ]);

    }

    /**
     * @param Request $request
     * @param $id
     * @return string
     */
    public function update(Request $request)
    {
        /**  Validate post information. */
        $validator = validator( $request->all(),
            [
                'post_id' => 'required|integer',
                'content' => 'string|max:256',
                'tag_ids'  => 'array',
                'category_id' => 'integer'
            ]
        );


        if ( $validator->fails() ) {

            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => $validator->errors()->first()
            ]);

        }

        /** @var Post $post */
        $post = Post::find($request->get('post_id'));

        if(!($post instanceof  Post)){

            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => 'Item not found.'
            ]);
        }

        try {

             $post->content = $request->get('content');
             $post->save();

        } catch ( \Illuminate\Database\QueryException $exception ) {

            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => $exception->getMessage()
            ]);
        }

        $post->tags()->detach();

        if( $request->has('tag_id') )
        {
            foreach( $request->get('tag_id') as $tag )
            {
                $array[] = [

                    'tag_id' => $tag,
                    'taggable_type' => Post::class,
                    'taggable_id' =>$request->get('post_id'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                ];
            }

            $result = TaggableTrait::createTaggable($array);

            if($result !== true)
            {
                return response()->json([
                    'status'  => 'error',
                    'title'   => 'Something wrong!',
                    'content' => $result
                ]);
            }

        }

        $post->categories()->detach();

        if( $request->has('category_id') )
        {
            $array = [

                'category_id' => $request->get('category_id'),
                'categorizable_type' => Post::class,
                'categorizable_id' => $request->get('post_id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $result = CategorizableTrait::createCategorizable($array);

            if($result !== true)
            {
                return response()->json([
                    'status'  => 'error',
                    'title'   => 'Something wrong!',
                    'content' => $result
                ]);
            }
        }

        return response()->json([
            'status'  => 'success',
            'title'   => 'Success!',
            'content' => 'Post updated.'
        ]);

    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        if(!($post instanceof  Post)){

            return response()->json([
                'status'  => 'error',
                'title'   => 'Something wrong!',
                'content' => 'Item not deleted.'
            ]);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        $post->forceDelete();

        return response()->json([
            'status'  => 'success',
            'title'   => 'Success!',
            'content' => 'Post deleted.'
        ]);

    }
}
