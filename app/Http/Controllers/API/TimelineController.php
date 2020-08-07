<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Post;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		return new PostCollection($request->user()->posts()->orderBy('created_at', 'desc')->with('user')->paginate(10));
	}
}