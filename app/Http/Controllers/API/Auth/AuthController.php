<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	/**
	 * Login a user.
	 *
	 * @param \App\Http\Requests\AuthRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function login(AuthRequest $request)
	{
		$data = $request->only(['email', 'password', 'device']);
		$device = $data['device'];
		$token = null;

		$credentials = [
			'email' => $data['email'],
			'password' => $data['password']
		];

		if (Auth::attempt($credentials)) {
			$user = Auth::user();
			$token = $this->createToken($user, $device);

			return response([
				'id' => $user->id,
				'name' => $user->name,
				'country' => $user->country,
				'avatar' => $request->getSchemeAndHttpHost() . '/uploads/' . $user->avatar,
				'token' => $token->plainTextToken
			]);
		}

		return response([
			'message' => 'The given data was invalid.',
			'errors' => [
				'email' => [
					'The provided credentials are incorrect.'
				]
			]
		], 422);
	}

	/**
	 * Register a new user.
	 *
	 * @param \App\Http\Requests\AuthRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register(AuthRequest $request)
	{
		$data = $request->only(['name', 'email', 'password', 'country', 'device']);
		$device = $data['device'];
		$data = [
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'country' => $data['country']
		];

		$user = User::create($data);
		$token = $this->createToken($user, $device);

		return response([
			'id' => $user->id,
			'token' => $token->plainTextToken
		], 201);
	}

	/**
	 * Logout a current user.
	 *
	 * @param \App\Http\Requests\AuthRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function logout(AuthRequest $request)
	{
		$device = $request->input('device');
		$request->user()->tokens()->where('name', $device)->delete();

		return response('', 204);
	}

	/**
	 * Create a new personal access token for the user, and revoke old tokens.
	 *
	 * @param \App\User $user
	 * @param string $device
	 *
	 * @return \Laravel\Sanctum\NewAccessToken
	 */
	private function createToken(User $user, string $device)
	{
		$user->tokens()->where('name', $device)->delete();

		return $user->createToken($device);
	}
}