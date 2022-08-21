<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class ProductUploadImageService extends AbstractUploadService implements UploadServiceInterface
{

	protected static $savePathTo = 'products/';

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}