<?php

namespace App\Http\Requests\Screencast;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistRequest extends FormRequest
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
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'name' => ['required', 'string'],
            'price' => ['numeric', 'required'],
            'description' => ['required', 'string'],
        ];
    }
}
