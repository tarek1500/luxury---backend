<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
		if ($this->routeIs('api.comments.index'))
		{
			return [
				'post_id' => 'required|integer|exists:posts,id'
			];
		}
		else if ($this->routeIs('api.comments.store'))
		{
			return [
				'body' => 'required|string|max:65535',
				'post_id' => 'required|integer|exists:posts,id'
			];
		}
		else if ($this->routeIs('api.comments.update'))
		{
			return [
				'body' => 'required|string|max:65535'
			];
		}

		return [];
	}
}