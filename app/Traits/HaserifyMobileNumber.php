<?php  

namespace App\Traits;

trait HaserifyMobileNumber
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
}