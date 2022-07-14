<?php

namespace App\Http\Resources;

use App\Models\Payments\Ewallet;
use App\Models\Payments\VirtualAccount;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "booking_code" => $this->booking_code,
            "payable_id" => $this->payable_id,
            "payable_type" => $this->payable_type == Ewallet::class ? 'EWALLET' : 'VIRTUAL_ACCOUNT',
            "user" => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
                'email' => $this->user?->email,
            ],
            "voucher_id" => $this->voucher,
            "currency" => $this->currency,
            "amount" =>  $this->amount,
            "discount_type" => $this->discount_type,
            "discount_amount" => $this->discount_amount,
            "tax" => $this->tax,
            "status" => $this->status,

            $this->mergeWhen($this->payable_type == Ewallet::class, [
                'ewallet_id' => $this->payable?->ewallet_id,
                'channel_code' => $this->payable?->channel_code,
                'mobile_number' => $this->payable?->mobile_number,
                'success_redirect_url' => $this->payable?->success_redirect_url,
                'desktop_web_checkout_url' => $this->payable?->desktop_web_checkout_url,
                'mobile_web_checkout_url' => $this->payable?->mobile_web_checkout_url,
                'callback_url' =>  $this->payable?->mobile_web_checkout_url,
                
            ]),

            $this->mergeWhen($this->payable_type == VirtualAccount::class, [
                'external_id' => $this->payable?->external_id,
                'owner_id' => $this->payable?->owner_id,
                'bank_code' => $this->payable?->bank_code,
                'merchant_code' => $this->payable?->merchant_code,
                'account_number' => $this->payable?->account_number,
                'expiration_date' => $this->payable?->expiration_date,
                
            ]),

            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
            
        ];
    }
}
