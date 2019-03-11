<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpotTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp() : void 
    {
        parent::setUp();
    }

    /** @test */
    public function a_spot_can_be_submitted()
    {
        $this->get('/spots/new')
            ->assertStatus(200)

        // TODO: Submit a spot
    }

    public function when_a_spot_is_created_an_email_is_sent_to_the_owner()
    {

    }

}
