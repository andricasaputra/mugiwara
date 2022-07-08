<?php  

namespace App\Contracts;

use Illuminate\Http\Request;

interface PaymentServiceInterface
{
	public function pay(Request $request);
}