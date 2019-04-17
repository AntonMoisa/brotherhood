<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Captcha;

class FeedbackRequest extends FormRequest
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
			'NAME' 		=> 'required|max:255',
			'COUNTRY' 	=> 'required|max:255',
			'EMAIL' 	=> 'required|email',
			'NEEDS' 	=> 'required',
			'COMPANY' 	=> 'nullable|max:255',
			'g-recaptcha-response' => 'required', new Captcha(),
        ];
	}
}
