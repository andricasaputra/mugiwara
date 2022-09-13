<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class PhotoDeliveryUploadService extends AbstractUploadService implements UploadServiceInterface
{
	protected static $savePathTo = 'products/deliverys/';
	protected static $shouldResize = false;

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}