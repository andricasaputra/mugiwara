<?php  

namespace App\Traits;

use Nette\Utils\Random;

trait VerifyMobileNumber
{
	public function hasVerifiedMobileNumber()
	{
		return ! is_null($this->mobile_verified_at);
	}

    public function markMobileNumberAsVerified()
    {
    	return $this->forceFill([
            'mobile_verified_at' => $this->freshTimestamp(),
            'mobile_verify_code' => NULL,
            'mobile_attempts_left' => 0,
        ])->save();
    }

    public function sendMobileNumberVerificationNotification()
    {
        if (auth()->check() && is_null(auth()->user()?->mobile_verify_code)) {
            $this->forceFill([
                'mobile_verify_code' => Random::generate(6, 1234567890),
                'mobile_attempts_left' => 4,
            ])->save();
        }

        $this->notify(new \App\Notifications\sendVerifyWhatsapp($this));
    }
}