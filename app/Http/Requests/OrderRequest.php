<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isNotAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'accomodation_id' => 'required',
            'room_id' => 'required',
            'check_in_date' => 'required',
            'check_in_time' => 'required',
            'stay_day' => 'required',
            'total_guest' => 'required'
        ];
    }
}
