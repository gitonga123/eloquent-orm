<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Str;
use Response;
use Illuminate\Http\Request;
use App\Http\Requests;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        $response = Response::json($posts, 200);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((!$request->title) || (!$request->content)) {
            $response = Response::json([
                'error' => [
                    'message' => 'Please enter all required fields'
                ]
            ], 422);
            return $response;
        }

        $post = new Post(array(
           'title' => $request->title,
           'content' => $request->content,
           'slug' => Str::slug($request->title, '-'),
            'user_id' => 5,
        ));
        $post->save();

        $response = Response::json([
            'message' => 'The post has been created successfully',
            'data' => $post,
        ], 201);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            $response = Response::json($post, 200);
        } else {
            $response = Response::json([
                'error' => [
                    'message' => 'This post cannot be found'
                ]
            ], 404);
        }

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ((!$request->title) || (!$request->content)) {
            $response = Response::json([
                'error' => [
                    'message' => 'Please enter all the required fields'
                ]
            ], 422);

            return $response;
        }

        $post = Post::find($id);
        if (!$post) {
            $response = Response::json([
                'error' => [
                    'message' => 'Record Not Found'
                ]
            ], 404);
            return $response;
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = Str::slug($request->title, '-');
        $post->save();

        $response = Response::json([
            'message' => 'The post has been update',
            'data' => $post
        ], 200);

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            $response = Response::json([
                'error' => [
                    'message' => 'The post cannot be found.'
                ]
            ], 404);

            return $response;
        }

        Post::destroy($id);

        $response = Response::json([
            'message' => 'The post has been deleted.'
        ], 200);

        return $response;
    }

    //CORS - Cross-Origin Resource Sharing - Mechanism that allows moderm
    // browsers to send and receive restricted data from a domain other than the
    // one that made the request
}
