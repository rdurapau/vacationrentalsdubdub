<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTokenTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void 
    {
        parent::setUp();
    }

    /** @test */
    public function example()
    {
        $this->get('/spots/new')
            ->assertStatus(200);
    }

    public function a_spot_can_be_edited_with_the_correct_edit_url()
    {

    }

    public function when_a_spot_is_created_an_edit_token_is_also_created()
    {

    }

    public function an_edit_token_email_can_be_resent()
    {
        
    }


}
