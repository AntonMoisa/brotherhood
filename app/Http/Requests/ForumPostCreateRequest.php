<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Captcha;

class ForumPostCreateRequest extends FormRequest
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
			'name' 	  => 'required|min:3|max:150',
			'country' => 'required|string|max:100',
			'email'   => 'nullable|email',
			'phone'   => 'nullable|integer|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			'text'    => 'string|min:3|max:300',
			'g-recaptcha-response' => 'required', new Captcha(),
		];
    }
}
