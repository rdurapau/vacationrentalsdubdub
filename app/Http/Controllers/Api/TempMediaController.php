<?php
namespace App\Http\Controllers\Api;

use App\TempMedia;
use App\Http\Resources\TempMedia as TempMediaResource;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TempMediaController extends ApiController
{
    /** 
     * Create a new TempMedia
     * Used for image upload forms that process before the associated property has been created
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image'
        ]);

        $photo = TempMedia::create();

        $photo
            ->addMedia(request()->file('file'))
            ->toMediaCollection();
        // $file = $request->file('file');
        // $name = uniqid() . '_' . trim($file->getClientOriginalName());

        // $photo = TempMedia::create([
        //     'filename' => $name
        // ]);

        // $path = Storage::putFileAs(
        //     $photo->storagePath, $file, $name
        // );

        // $file->storeAs($photo->storagePath, $name);

        return response()
            // ->json(new TempMediaResource($photo), 201);
            ->json(['id' => $photo->id], 201);
    }
}
