<?php

namespace Tests\Unit;

use App\BookingRequest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void 
    {
        parent::setUp();

        // $this->spot = factory('App\Spot')->create();
        $this->request = factory('App\BookingRequest')->create([
            'spot_id' => factory('App\Spot')->create()->id
        ]);
        
    }

    public function test_it_has_a_spot()
    {
        $this->assertInstanceOf('App\Spot', $this->request->spot);
    }

}
