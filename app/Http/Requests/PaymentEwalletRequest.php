<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentEwalletRequest extends FormRequest
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
            "booking_code" => "required",
            "channel_category" => "required",
            "channel_code"=>"required",
            "amount" => "required|numeric",
            "mobile_number" => "required"
        ];
    }
}
