<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeRequest extends FormRequest
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
            'name' => 'nullable|string|min:1|max:20',
            'introduce' => 'nullable|string|min:1|max:100',
            'avatar_hash' => 'bail|nullable|size:32|exists:images,hash',
        ];

//        switch ($this->method()) {
//            case 'GET':
//            case 'DELETE':
//                return [];
//            case 'POST':
//                return [
////                    'name' => 'required|string|min:1|max:20',
////                    'introduce' => 'required|string|min:1|max:100',
////                    'avatar_hash' => 'bail|nullable|size:32|exists:images,hash',
//                ];
//            case 'PUT':
//            case 'PATCH':
//                return [
//                    'name' => 'nullable|string|min:1|max:20',
//                    'introduce' => 'nullable|string|min:1|max:100',
//                    'avatar_hash' => 'bail|nullable|size:32|exists:images,hash',
//                ];
//            default:
//                break;
//        }
    }
}
