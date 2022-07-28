<?php

namespace App\Uploads;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class AbstractUploadService
{
	protected static $image;
	protected static $imagename;
	protected static $filepath;
	protected static $savePathTo = 'data/';

	protected static function upload(UploadedFile $file)
	{
		static::$image = $file;

	    static::$imagename = time() .'_'. static::$image->getClientOriginalName();

		Storage::disk('public')->put(
			static::$savePathTo . static::$imagename, 
			file_get_contents(static::$image->getRealPath())
		);

	    return static::getImageName();
	}

	public static function getImageName()
	{
		return static::$imagename;
	}
}