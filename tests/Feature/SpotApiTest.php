<?php

namespace Tests\Feature;

use App\BaseSpot;
use App\ModerationStatus;
use GeoJson\GeoJson;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** @group api */
class SpotApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function setUp() : void 
    {
        parent::setUp();
    }

    /** @test */
    public function all_active_spots_can_be_publically_listed_in_valid_geojson()
    {
        $activeSpotCount = 5;
        factory('App\Spot',$activeSpotCount)->create();
        factory('App\Spot')->states('pending')->create();
        factory('App\Spot')->states('rejected')->create();

        $response = $this->json(
                'GET',
                "{$this->apiRoot}/gj"
            )->assertStatus(200);

        $json = json_decode($response->getContent());
        $geoJson = GeoJson::jsonUnserialize($json);

        $this->assertInstanceOf('GeoJson\Feature\FeatureCollection', $geoJson);
        $this->assertEquals($activeSpotCount, $geoJson->count());
    }

    public function all_active_spots_can_be_publically_listed()
    {

    }
    
    public function an_active_spot_can_be_publically_viewed()
    {

    }

    public function pending_spots_cannot_be_publically_viewed()
    {

    }

    public function pending_spots_can_be_viewed_with_auth()
    {

    }

    public function rejected_spots_cannot_be_publically_viewed()
    {

    }

    public function rejected_spots_can_be_viewed_with_auth()
    {

    }


    // Maybe
    public function a_spot_can_be_updated_with_auth()
    {

    }

    public function a_spot_cannot_be_updated_without_auth()
    {

    }


}
