<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class PaymentListUploadService extends AbstractUploadService implements UploadServiceInterface
{

	protected static $savePathTo = 'payments/';

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}