<?php  

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface UploadServiceInterface
{
	public function process(UploadedFile $file);
}