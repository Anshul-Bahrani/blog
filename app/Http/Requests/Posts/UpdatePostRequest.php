<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts,title,'. $this->post->id,
            'excerpt' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpg,jpeg,gif,png|max:1024',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
