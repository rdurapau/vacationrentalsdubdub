<?php

namespace Tests\Unit;

use App\Submission;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_cannot_query_approved_spots()
    {
        $spot = factory('App\Spot')->create();
        
        $this->assertNull(Submission::find($spot->id));
        $this->assertCount(0,Submission::all());  
    }
    
    public function test_it_can_query_pending_spots()
    {
        $spot = factory('App\Submission')->create();

        $this->assertEquals($spot->id, Submission::first()->id);
        $this->assertEquals($spot->id, Submission::find($spot->id)->id);
    }

    public function test_it_cannot_query_rejecteed_spots()
    {
        $spot = factory('App\Spot')->states('rejected')->create();
        
        $this->assertNull(Submission::find($spot->id));
        $this->assertCount(0,Submission::all());
    }

    public function test_it_can_query_rejected_spots_with_rejected_scope()
    {
        $spot = factory('App\Spot')->states('rejected')->create();
        
        $this->assertEquals($spot->id, Submission::rejected()->where('id',$spot->id)->first()->id);
        $this->assertCount(1,Submission::rejected()->get());  
    }
}
