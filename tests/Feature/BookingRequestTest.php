<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingRequestTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void 
    {
        parent::setUp();
    }

    /** @test */
    public function a_booking_request_can_be_submitted()
    {
        $spot = factory('App\Spot')->create();

        $r = $this->post("/spots/{$spot->id}/requests", [
                'name' => 'Caleb White',
                'email' => 'test@email.com',
                'email_confirmation' => 'test@email.com',
                'phone' => '1112223333',
                'dates' => 'Aug 1, 2019 - Aug 5, 2019'
            ])->assertRedirect();
            // ]); dd($r->decodeResponseJson());
        
        $this->assertDatabaseHas('booking_requests', [
            'name' => 'Caleb White',
            'email' => 'test@email.com',
            'phone' => '1112223333',
            'dates' => 'Aug 1, 2019 - Aug 5, 2019',
            'spot_id' => $spot->id
        ]);
    }

    /** @test */
    public function when_a_booking_request_is_submitted_an_email_is_sent_to_the_owner()
    {
        Mail::fake();

        $spot = factory('App\Spot')->create();

        $r = $this->post("/spots/{$spot->id}/requests", [
                'name' => 'Caleb White',
                'email' => 'test@email.com',
                'email_confirmation' => 'test@email.com',
                'phone' => '1112223333',
                'dates' => 'Aug 1, 2019 - Aug 5, 2019'
            ])->assertRedirect();
            // ]); dd($r->decodeResponseJson());
        
        $bookingRequest = $spot->bookingRequests()->first();
        // dd($bookingRequest->toArray());
        
        Mail::assertSent(\App\Mail\Booking\NewBookingRequest::class, function ($mail) use ($bookingRequest) {
            return $mail->bookingRequest->id === $bookingRequest->id;
        });
    }

    /** @test */
    public function when_a_booking_request_is_submitted_an_email_is_sent_to_the_submitter()
    {
        Mail::fake();

        $spot = factory('App\Spot')->create();

        $r = $this->post("/spots/{$spot->id}/requests", [
                'name' => 'Caleb White',
                'email' => 'test@email.com',
                'email_confirmation' => 'test@email.com',
                'phone' => '1112223333',
                'dates' => 'Aug 1, 2019 - Aug 5, 2019'
            ])->assertRedirect();
            // ]); dd($r->decodeResponseJson());
        
        $bookingRequest = $spot->bookingRequests()->first();
        // dd($bookingRequest->toArray());
        
        Mail::assertSent(\App\Mail\Booking\BookingRequestConfirm::class, function ($mail) use ($bookingRequest) {
            return $mail->bookingRequest->id === $bookingRequest->id;
        });
    }
}
