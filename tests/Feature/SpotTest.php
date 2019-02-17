<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpotTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function a_spot_can_be_submitted()
    {
        $this->get('/spots/new')
            ->assertStatus(200)
            ->assertSee('Submit Your Property');
    }

    public function a_spot_can_be_approved()
    {

    }

    public function a_spot_can_be_edited_with_the_correct_edit_url()
    {

    }


}
