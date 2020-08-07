<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param string $path
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(string $path)
	{
		return response(Storage::get($path))->header('Content-Type', Storage::mimeType($path));
	}
}