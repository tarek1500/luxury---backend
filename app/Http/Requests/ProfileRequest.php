<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
		return [
			'name' => 'string|max:255',
			'email' => 'max:255|email|unique:users,email,' . $this->user()->id,
			'password' => 'string|max:255',
			'country' => 'string|max:255',
			'avatar' => 'image|max:4096'
		];
	}
}