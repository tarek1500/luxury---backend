<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
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
		return response(new UserResource($request->user()));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\ProfileRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProfileRequest $request)
	{
		$data = $request->only(['name', 'email', 'country']);

		if ($request->has('password'))
			$data['password'] = Hash::make($request->input('password'));

		if ($request->has('avatar')) {
			Storage::delete($request->user()->avatar);
			$data['avatar'] = $request->file('avatar')->store('imgs/avatars');
		}

		$request->user()->update($data);

		return response($request->has('avatar') ? [
			'avatar' => $request->getSchemeAndHttpHost() . '/uploads/' . $data['avatar']
		] : []);
	}
}