<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class FacilityIconUploadService extends AbstractUploadService implements UploadServiceInterface
{
	protected static $savePathTo = 'images/facilities';

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}