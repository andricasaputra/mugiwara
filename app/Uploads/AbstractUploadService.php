<?php  

namespace App\Uploads;

use Illuminate\Http\UploadedFile;

abstract class AbstractUploadService
{
	protected static $image;
	protected static $imagename;
	protected static $filepath;
	protected static $savePathTo = 'images/rooms';

	protected static function upload(UploadedFile $file)
	{
		static::$image = $file;

	    static::$imagename = time() .'_'. static::$image->getClientOriginalName();
	 
	    static::$filepath = public_path(static::$savePathTo);

	    if (! file_exists(static::$filepath)) {
		    mkdir(static::$filepath, 0777, true);
		}

		static::$image->move(static::$filepath, static::$imagename);

	    return static::getImageName();
	}

	public static function getImageName()
	{
		return static::$imagename;
	}
}