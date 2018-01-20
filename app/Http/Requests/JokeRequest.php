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
                    'content' => 'required|min:1',
                    'image_hash' => 'nullable|size:32|exists:images'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'content' => 'required|min:1',
                    'image_hash' => 'nullable|size:32|exists:images'
                ];
            default:
                break;
        }
    }
}
