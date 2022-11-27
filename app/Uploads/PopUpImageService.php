<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class PopUpImageService extends AbstractUploadService implements UploadServiceInterface
{

	protected static $savePathTo = 'popups/';

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}