<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoomRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'room_number' => 'required|string',
            'type_id' => 'required|numeric',
            'max_guest' => 'required|numeric',
            'facility' => 'required',
            'price' => 'required|string',
            'discount_type' => 'nullable|string',
            'discount_amuount' => 'nullable|numeric',
            'room_image.*' => Rule::filepond([
                'required',
                'image',
                'max:3000'
            ])
        ];
    }
}
