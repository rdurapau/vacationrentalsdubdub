<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseSpotTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void 
    {
        parent::setUp();

        $this->spot = factory('App\BaseSpot')->create();
    }

    public function test_it_has_edit_tokens()
    {
        $this->assertCount(1,$this->spot->editTokens);
    }

    public function test_it_has_an_edit_token_which_is_the_most_recent()
    {
        $token = factory('App\EditToken')->create(['spot_id' => $this->spot->id]);
               
        $this->assertEquals($token->id,$this->spot->editToken->id);
    }

    public function test_it_has_booking_requests()
    {
        factory('App\BookingRequest')->create(['spot_id' => $this->spot->id]);
        $this->assertCount(1,$this->spot->bookingRequests);
    }

    public function test_it_has_a_full_address_attribute()
    {
        $this->assertEquals(
            "{$this->spot->address1}, {$this->spot->city}, {$this->spot->state} {$this->spot->postal_code}",
            $this->spot->full_address
        );
    }

    public function test_it_has_amenities()
    {
        $amenity = factory('App\Amenity')->create();
        $this->spot->amenities()->attach($amenity);
        $this->assertCount(1, $this->spot->amenities);
    }

    public function test_it_has_an_edit_url_attribute()
    {
        $this->assertEquals($this->spot->editToken->url, $this->spot->edit_url);
    }

    public function test_it_can_resend_the_edit_url_email()
    {
        Mail::fake();

        $this->spot->resendEditUrl();
        $spot = $this->spot;
        Mail::assertSent(\App\Mail\SpotEditUrl::class, function ($mail) use ($spot) {
            return (($mail->spot->id === $spot->id) && ($mail->token->id === $spot->editToken->id));
        });
    }

}
