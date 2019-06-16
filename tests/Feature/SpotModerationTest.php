<?php

namespace Tests\Feature;

use App\Spot;
use App\ModerationStatus;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpotModerationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function setUp(): void 
    {
        parent::setUp();
    }

    /** @test */
    public function a_submitted_spot_can_be_approved()
    {
        $spot = factory('App\Submission')->create();
        $spot->approve();

        $this->assertDatabaseHas('spots', [
            'id' => $spot->id,
            'moderation_status' => ModerationStatus::APPROVED
        ]);
    }

    /** @test */
    public function when_a_spot_is_approved_an_email_is_sent_to_the_owner()
    {
        Mail::fake();

        $spot = factory('App\Submission')->create();
        $spot->approve();
        
        Mail::assertSent(\App\Mail\SpotApproved::class, function ($mail) use ($spot) {
            return $mail->spot->id === $spot->id;
        });
    }

    /** @test */
    public function a_spot_can_be_rejected()
    {
        $spot = factory('App\Submission')->create();
        $spot->reject();

        $this->assertDatabaseHas('spots', [
            'id' => $spot->id,
            'moderation_status' => ModerationStatus::REJECTED
        ]);
    }

    /** @test */
    public function when_a_spot_is_rejected_an_email_is_sent_to_the_owner()
    {
        Mail::fake();

        $spot = factory('App\Submission')->create();
        $spot->reject();
        
        Mail::assertSent(\App\Mail\SpotRejected::class, function ($mail) use ($spot) {
            return $mail->spot->id === $spot->id;
        });
    }

    /** @test */
    public function a_spot_can_be_approved_via_the_api()
    {
        $spot = factory('App\Submission')->create();
        $r = $this->json(
            'POST',
            "{$this->apiRoot}/spots/{$spot->id}/moderate",
            [
                'status' => 'approved',
                '_method'=>'PUT'
            ]
        )->assertStatus(204);
        // );dd($r->decodeResponseJson());
        
        $spot->moderate('approved');

        $this->assertDatabaseHas('spots', [
            'id' => $spot->id,
            'moderation_status' => ModerationStatus::APPROVED
        ]);
    }

    /** @test */
    public function a_spot_can_be_rejected_via_the_api()
    {
        $spot = factory('App\Submission')->create();
        $r = $this->json(
            'POST',
            "{$this->apiRoot}/spots/{$spot->id}/moderate",
            [
                'status' => 'rejected',
                '_method'=>'PUT'
            ]
        )->assertStatus(204);
        // );dd($r->decodeResponseJson());

        $this->assertDatabaseHas('spots', [
            'id' => $spot->id,
            'moderation_status' => ModerationStatus::REJECTED
        ]);
    }

}
