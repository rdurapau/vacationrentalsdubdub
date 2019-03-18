<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AmenityTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void 
    {
        parent::setUp();

        $this->amenity = factory('App\Amenity')->create();
    }

    public function test_it_has_spots()
    {
        $spot = factory('App\Spot')->create();
        $this->amenity->spots()->attach($spot);
        $this->assertCount(1, $this->amenity->spots);
    }
    
}
