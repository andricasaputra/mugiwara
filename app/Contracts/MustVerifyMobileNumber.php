<?php  

namespace App\Contracts;

interface MustVerifyMobileNumber
{
	/**
     * Determine if the user has verified their MobileNumber address.
     *
     * @return bool
     */
    public function hasVerifiedMobileNumber();

    /**
     * Mark the given user's MobileNumber as verified.
     *
     * @return bool
     */
    public function markMobileNumberAsVerified();

}