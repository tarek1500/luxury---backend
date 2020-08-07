<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentCollection;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param \App\Http\Requests\CommentRequest; $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(CommentRequest $request)
	{
		return new CommentCollection(Comment::where('post_id', $request->input('post_id'))->with('user')->orderBy('created_at', 'asc')->paginate(10));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\CommentRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(CommentRequest $request)
	{
		$comment = Comment::create($request->only(['body', 'post_id']) + [
			'user_id' => $request->user()->id
		]);

		return response([
			'id' => $comment->id
		], 201);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\CommentRequest $request
	 * @param \App\Comment $comment
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(CommentRequest $request, Comment $comment)
	{
		if ($request->user()->can('update', $comment))
		{
			$comment->update($request->only(['body']));

			return response([], 204);
		}

		return response([], 403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Comment $comment
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Comment $comment)
	{
		if ($request->user()->can('delete', $comment))
		{
			$comment->delete();

			return response([], 204);
		}

		return response([], 403);
	}
}