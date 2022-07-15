<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class PhotoProfileUploadService extends AbstractUploadService implements UploadServiceInterface
{
	protected static $savePathTo = 'avatars/';

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}