<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameDb = str_random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameDb);
            return [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
        }
        return null;
    }

    public function storageTraitUploadMultiple($file, $folderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameDb = str_random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameDb);
        return [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
    }
}
