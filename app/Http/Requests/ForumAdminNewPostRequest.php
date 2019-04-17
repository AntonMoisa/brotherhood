<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForumAdminNewPostRequest extends FormRequest
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
			'text'    		=> 'string|min:3|max:300',
			'user_id' 		=> 'required|integer',
			'is_published' 	=> 'required|integer',
			'country' 		=> 'required|string|max:100',
			'category' 		=> 'required|string|max:100',
		];
	}
}