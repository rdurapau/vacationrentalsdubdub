<?php

namespace Tests\Feature;

use App\TempUpload;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TempUploadTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function setUp() : void 
    {
        parent::setUp();
    }

    /** @test */
    public function a_temp_upload_can_be_uploaded()
    {   
        Storage::fake('local');
 
        $r = $this->json('post', 'api/temp-uploads', [
            'file' => $file = UploadedFile::fake()->image('spot-photo.jpg')
        ])->assertStatus(201);
        // ]);dd($r->decodeResponseJson());

        $responseContent = $r->decodeResponseJson();

        $this->assertDatabaseHas('temp_uploads',[
            'filename' => $responseContent['filename']
        ]);

        Storage::disk('local')->assertExists('temp/uploads/' . $responseContent['filename']);

    }

    /** @test */
    public function a_temp_upload_can_only_be_an_image()
    {
        Storage::fake('local');
 
        $r = $this->json('post', 'api/temp-uploads', [
            'file' => $file = UploadedFile::fake()->create('spot-photo.pdf',100)
        ])->assertStatus(422);

        $r = $this->json('post', 'api/temp-uploads', [
            'file' => 'nah-brah'
        ])->assertStatus(422);

        $this->assertEquals(0,TempUpload::count());
    }

    public function temp_uploads_are_deleted_after_their_expires_at_datetime()
    {

    }
}
