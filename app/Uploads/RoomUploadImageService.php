<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class RoomUploadImageService extends AbstractUploadService implements UploadServiceInterface
{
	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}