<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function setUp(): void 
    {
        parent::setUp();
    }

    /** @test */
    public function a_booking_request_can_be_submitted()
    {
        $spot = factory('App\Spot')->create();
        $data = $this->getFakeBookingRequestData();

        $r = $this->post("/spots/{$spot->id}/requests", $data)
            ->assertSessionHasNoErrors()    
            ->assertRedirect();
            // ]); dd($r->decodeResponseJson());

        unset($data['email_confirmation']);
        $dbdata = array_merge($data, [
            'spot_id' => $spot->id
        ]);

        $this->assertDatabaseHas('booking_requests', $dbdata);
    }

    /** @test */
    public function when_a_booking_request_is_submitted_an_email_is_sent_to_the_owner()
    {
        Mail::fake();

        $spot = factory('App\Spot')->create();
        
        $data = $this->getFakeBookingRequestData();
        $r = $this->post("/spots/{$spot->id}/requests", $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
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

        $data = $this->getFakeBookingRequestData();
        $r = $this->post("/spots/{$spot->id}/requests", $data)->assertRedirect();
            // ]); dd($r->decodeResponseJson());
        
        $bookingRequest = $spot->bookingRequests()->first();
        
        Mail::assertSent(\App\Mail\Booking\BookingRequestConfirm::class, function ($mail) use ($bookingRequest) {
            return $mail->bookingRequest->id === $bookingRequest->id;
        });
    }
}
