<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(6);

        if (count($posts) > 0) {
            $posts = PostResource::collection($posts);

            $posts->additional([
                'all_ok' => 'yes',
            ]);

            return $posts;

        } else {
            return response([
                'all_ok' => 'no',
                'message' => 'Record is Not Found!',
            ], 404);
        }
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

    public function store(Request $request)
    {

        $request->validate([
            'task' => 'required',
        ]);

        $post = new Post();

        $post->task = $request->task;

        $post->save();

        if ($post) {
            return response([
                'all_ok' => 'yes',
                'message' => 'Record is Successfully Created!',
                'post' => $post,
            ], 201);
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

        $post = Post::find($id);

        if ($post) {
            $post = new PostResource($post);

            return response([
                'all_ok' => 'yes',
                'message' => 'Record is Successfully Retrieved!',
                'post' => $post,
            ], 200);

        } else {
            return response([
                'all_ok' => 'no',
                'message' => 'Record is Not Found!',
            ], 404);
        }
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

        //  $this->authorize('update_by_admin', $post);

        $request->validate([
            'task' => 'required',
        ]);

        $post = Post::find($id);

        //Authorization Check

        if ($post) {

            $post->update($request->all());

            $post = new PostResource($post);

            return response([
                'all_ok' => 'yes',
                'message' => 'Record is Updated Successfully!',
                'post' => $post,
            ], 200);

        } else {
            return response([
                'all_ok' => 'no',
                'message' => 'Record is Not Found!',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $post = Post::find($id);

        if ($post) {

            $is_delete = $post->delete();

            if ($is_delete) {

                return response([
                    'all_ok' => 'yes',
                    'message' => 'The Post is Deleted Successfully!!',
                ], 200);

            }
        } else {

            return response([
                'all_ok' => 'no',
                'message' => 'The Post Does Not Exist!!',
            ], 401);

        }
    }
}
