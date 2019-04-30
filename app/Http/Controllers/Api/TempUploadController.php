<?php
namespace App\Http\Controllers\Api;

use App\TempUpload;
use App\Http\Resources\TempUpload as TempUploadResource;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TempUploadController extends ApiController
{
    /** 
     * Create a new TempUpload
     * Used for image upload forms that process before the associated property has been created
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image'
        ]);

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $photo = TempUpload::create([
            'filename' => $name
        ]);

        $path = Storage::putFileAs(
            $photo->storagePath, $file, $name
        );

        // $file->storeAs($photo->storagePath, $name);

        return response()
            ->json(new TempUploadResource($photo), 201);
    }
}
