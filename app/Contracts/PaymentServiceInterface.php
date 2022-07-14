<?php  

namespace App\Contracts;

use Illuminate\Http\Request;

interface PaymentServiceInterface
{
	public function createPayment(Request $request);
}