<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'=>['required','string','max:255','min:2'],
            'body'=>['required','string'],
            'cover_image'=>['required','max:1000','mimes:png,jpg,jpeg'],
            // 'pinned'=>['Required','boolean'],
            'tags'=>['string']
        ];
    }
}
