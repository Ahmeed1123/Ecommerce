<?php

namespace App\Trait;

trait uploadImgTrait
{
    protected function saveImage($photo,$folder) {
        // save photo in folder

        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'storage/'.$folder;
        $photo->move($path, $file_name);

        return $file_name;
    }
}
