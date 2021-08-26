<?php

namespace App\Http\Requests\Screencast;

use App\Models\Screencast\Tag;
use Illuminate\Validation\Rule;
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
            'thumbnail' => ['image', 'mimes:png,jpg,jpeg', Rule::requiredIf(request()->routeIs('playlists.store'))],
            'tags' => ['required', 'array', 'in:' . implode(",", Tag::validTag())],
            'name' => ['required', 'string'],
            'price' => ['numeric', 'required'],
            'description' => ['required', 'string'],
        ];
    }
}
