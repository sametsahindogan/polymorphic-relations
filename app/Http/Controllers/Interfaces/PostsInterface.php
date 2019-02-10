<?php

namespace App\Http\Controllers\Interfaces;


use Illuminate\Http\Request;

interface PostsInterface
{
    /**
     * List of all posts.
     * @return object
     */
    public function get();

    /**
     * Get post by ID.
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Create post.
     * @return string
     */
    public function create(Request $request);

    /**
     * Update post by ID.
     * @return string
     */
    public function update(Request $request);

    /**
     * Delete post by ID.
     * @return string
     */
    public function delete($id);

}