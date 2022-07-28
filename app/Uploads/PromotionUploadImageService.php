<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class PromotionUploadImageService extends AbstractUploadService implements UploadServiceInterface
{

	protected static $savePathTo = 'promotions/';

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}