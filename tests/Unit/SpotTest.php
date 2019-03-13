<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpotTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function it_can_query_approved_spots()
    {

    }
    
    public function it_cannot_query_pending_spots()
    {

    }

    public function it_cannot_query_rejected_spots()
    {

    }

}
