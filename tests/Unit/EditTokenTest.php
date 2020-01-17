<?php

namespace Tests\Unit;

use App\EditToken;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTokenTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void 
    {
        parent::setUp();

        factory('App\Spot')->create();
        $this->token = EditToken::first();
    }

    public function test_it_has_a_spot()
    {
        $this->assertInstanceOf('App\BaseSpot', $this->token->spot);
    }

    public function test_it_has_a_url_attribute()
    {
        $this->assertEquals(
            url("/s/{$this->token->spot_id}/{$this->token->token}"),
            $this->token->url
        );
    }

    public function test_it_can_resend_the_edit_url_email()
    {
        Mail::fake();

        $this->token->resendEmail();
        $token = $this->token;
        Mail::assertSent(\App\Mail\SpotEditUrl::class, function ($mail) use ($token) {
            return (($mail->token->id == $token->id) && ($mail->spot->id == $token->spot_id));
        });
    }

}
