<?php  

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;

trait HasOldImageToDelete
{
    public function deleteOldImage($model, $path)
    {
        //$oldimage = url('storage/' . $path . '/' . $model->image?->image);

        //$oldimage = storage_path($path . DIRECTORY_SEPARATOR . $model->image?->image);

        $oldimage = \Storage::disk('public')->path($path . DIRECTORY_SEPARATOR . $model->image?->image);

        if(file_exists($oldimage)){
            unlink($oldimage);
        }

        $model->image()?->delete();
    }
}