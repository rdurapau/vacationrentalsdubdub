<?php

namespace Tests\Feature;

use App\BaseSpot;
use App\ModerationStatus;

use GeoJson\GeoJson;
use GeoJson\Exception\UnserializationException;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** @group api */
class SubmissionTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function setUp() : void 
    {
        parent::setUp();
    }

    /** @test */
    public function a_spot_can_be_submitted()
    {       
        $data = $this->getFakeSpotData();
        $data['email_confirmation'] = $data['email'];

        $r = $this->json(
                'POST',
                "{$this->apiRoot}/submissions",
                $data
            )->assertSessionHasNoErrors()
            ->assertStatus(201);
            // ;dd($r->getContent());

        $this->assertDatabaseHas('spots', [
            'email' => $data['email'],
            'desc' => $data['desc'],
            'price' => $data['price'],
            'moderated_by' => NULL,
            'moderated_at' => NULL,
            'moderation_status' => ModerationStatus::PENDING
        ]);

    }

    /** @test */
    public function when_a_spot_is_submitted_a_confirmation_email_is_sent_to_the_owner()
    {
        Mail::fake();

        $data = $this->getFakeSpotData();
        $data['email_confirmation'] = $data['email'];

        $r = $this->json(
                'POST',
                "{$this->apiRoot}/submissions"
                , $data
            )->assertSessionHasNoErrors()
            ->assertStatus(201);
            // );dd($r->decodeResponseJson());
            // );dd($r->getContent());

        $spot = BaseSpot::where('desc', $data['desc'])->first();
        
        Mail::assertSent(\App\Mail\SpotSubmitted::class, function ($mail) use ($spot) {
            return ($mail->spot->id === $spot->id)
                && $mail->hasTo($spot->email);
        });
    }
}
