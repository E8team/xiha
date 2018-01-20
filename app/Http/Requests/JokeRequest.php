<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JokeRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'content' => 'required_without:image_hash|min:1|max:2000',
                    'image_hash' => 'bail|required_without:content|size:32|exists:images,hash'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'content' => 'nullable|min:1|max:2000',
                    'image_hash' => 'bail|nullable|size:32|exists:images,hash'
                ];
            default:
                break;
        }
    }
}
