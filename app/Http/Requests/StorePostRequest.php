<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => 'required|min:3|unique:posts,title',
            'description' => 'required|min:10',
            'post_creator' => 'required|exists:App\Models\User,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }

    public function messages(): array
    {
        return [
            //
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 3 characters',
            'title.unique' => 'Title already exists',
            'description.required' => 'description is required',
            'description.min' => 'description must be at least 10 characters',
            'post_creator.required' => 'User is required',
            'post_creator.exists' => 'User does not exist',
        ];
    }
}