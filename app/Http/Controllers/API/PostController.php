<?php

namespace App\Http\Controllers\Api;

use Fruitcake\Cors\CorsServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\PostRepository;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
  
        $newPost = (new PostRepository())->store($request);

        if ($newPost) {
            return response()->json(['info' => 'Comment successfully created!'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        if ($post = Post::find($id)) {
            if (Gate::allows('creator-or-admin', $post)) {
                $update = (new PostRepository())->update($request, $post);
                if ($update) {
                    return response()->json(['status' => 'success', 'info' => 'Post successfully updated!'], 200);
                }
            } else {
                return response()->json(['errors' => ['auth' => ['Only the creator or admin can edit the comment information']]], 403);
            } 
        } else {
            return response()->json(['errors' => ['post' => ['comment not found']]], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
