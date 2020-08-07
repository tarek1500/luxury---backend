<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Post;
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
		return new PostCollection(Post::with('user')->orderBy('created_at', 'desc')->paginate(10));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\PostRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostRequest $request)
	{
		$post = $request->user()->posts()->create($request->only(['body']));

		return response([
			'id' => $post->id
		], 201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Post $post
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Post $post)
	{
		return response(new PostResource($post->load('user')));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\PostRequest $request
	 * @param \App\Post $post
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(PostRequest $request, Post $post)
	{
		if ($request->user()->can('update', $post))
		{
			$post->update($request->only(['body']));

			return response([], 204);
		}

		return response([], 403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Post $post
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Post $post)
	{
		if ($request->user()->can('delete', $post))
		{
			$post->delete();

			return response([], 204);
		}

		return response([], 403);
	}
}