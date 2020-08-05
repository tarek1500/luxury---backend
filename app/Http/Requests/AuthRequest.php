<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->routeIs('api.auth.login'))
		{
			return [
				'email' => 'required|max:255|email',
				'password' => 'required|string|max:255',
				'device' => 'required|string|max:255'
			];
		}
		else if ($this->routeIs('api.auth.register'))
		{
			return [
				'name' => 'required|string|max:255',
				'email' => 'required|max:255|email|unique:users',
				'password' => 'required|string|max:255',
				'country' => 'required|string|max:255',
				'device' => 'required|string|max:255'
			];
		}
		else if ($this->routeIs('api.auth.logout'))
		{
			return [
				'device' => 'required|string|max:255'
			];
		}

		return [];
	}
}