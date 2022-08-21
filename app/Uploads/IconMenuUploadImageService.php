<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class IconMenuUploadImageService extends AbstractUploadService implements UploadServiceInterface
{

	protected static $savePathTo = 'icons/';

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}