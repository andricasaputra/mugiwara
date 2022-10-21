<?php  

namespace App\Uploads;

use App\Contracts\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class WithdrawTransferImageService extends AbstractUploadService implements UploadServiceInterface
{

	protected static $savePathTo = 'withdraws/';

	public function process(UploadedFile $file)
	{
		return parent::upload($file);
	}
}