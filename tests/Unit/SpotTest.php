<?php

namespace Tests\Unit;

use App\Spot;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpotTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function test_it_can_query_approved_spots()
    {
        $spot = factory('App\Spot')->create();
        
        $this->assertEquals($spot->id, Spot::first()->id);
        $this->assertEquals($spot->id, Spot::find($spot->id)->id);
    }
    
    public function test_it_cannot_query_pending_spots()
    {
        $spot = factory('App\Spot')->states('pending')->create();

        $this->assertNull(Spot::find($spot->id));
        $this->assertCount(0,Spot::all());
    }

    public function test_it_cannot_query_rejected_spots()
    {
        $spot = factory('App\Spot')->states('rejected')->create();

        $this->assertNull(Spot::find($spot->id));
        $this->assertCount(0,Spot::all());
    }
}