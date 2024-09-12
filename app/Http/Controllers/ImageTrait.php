<?php

namespace App\Http\Controllers;


use File;

trait ImageTrait
{

    public function uploadImage($image): string
    {
        $logo = time() + random_int(0, 999) . '.' . $image->extension();
        $image->move(('images') . '/' . date('d-m-Y'), $logo);
        return '/images/' . date('d-m-Y') . '/' . $logo;
    }

    public function uploadFile($file): string
    {
        $logo = time() + random_int(0, 999) . '.' . $file->extension();
        $file->move(('files') . '/' . date('d-m-Y'), $logo);
        return '/files/' . date('d-m-Y') . '/' . $logo;
    }

    public function deleteImage($image_path): void
    {
        if (!empty($image_path)) {
            $path = public_path($image_path);

            $isExists = File::exists($path);

            if ($isExists) {
                unlink(public_path() . $image_path);
            }
        }
    }

}
