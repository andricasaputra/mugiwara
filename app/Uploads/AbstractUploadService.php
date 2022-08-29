<?php

namespace App\Uploads;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

abstract class AbstractUploadService
{
	protected static $image;
	protected static $imagename;
	protected static $filepath;
	protected static $savePathTo = 'data/';
	protected static $shouldResize = false;

	protected static function upload(UploadedFile $file)
	{
		static::$image = $file;

	    static::$imagename = time() .'_'. static::$image->getClientOriginalName();

	    if(static::$shouldResize){

	    	Image::make(file_get_contents(static::$image->getRealPath()))
	    		->resize(200, 200, fn ($const) => $const->aspectRatio())
	    		->save(storage_path() . '/app/public/' . static::$savePathTo . static::$imagename);

	    }else{

	    	Storage::disk('public')->put(
				static::$savePathTo . static::$imagename, 
				file_get_contents(static::$image->getRealPath())
			);
	    }	

	    return static::getImageName();
	}

	public static function getImageName()
	{
		return static::$imagename;
	}
}