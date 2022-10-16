<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class PhotoPickupUploadService extends AbstractUploadService implements UploadServiceInterface
{
	protected static $savePathTo = 'products/pickups/';
	protected static $shouldResize = true;

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}