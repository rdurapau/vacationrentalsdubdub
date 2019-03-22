<?php

namespace Tests\Feature;

use App\BaseSpot;
use App\ModerationStatus;

use GeoJson\GeoJson;
use GeoJson\Exception\UnserializationException;

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
    public function all_active_spots_can_be_publically_listed()
    {
        $activeSpotCount = 5;
        factory('App\Spot',$activeSpotCount)->create();
        
        // Create pending and rejected spots to ensure they don't show up in the geoJSON
        factory('App\Spot')->states('pending')->create();
        factory('App\Spot')->states('rejected')->create();

        $response = $this->json(
            'GET',
            "{$this->apiRoot}/spots"
        )->assertStatus(200);

        $data = json_decode($response->getContent(), true);

        // This should NOT be valid geoJSON
        $this->expectException(UnserializationException::class);
        GeoJson::jsonUnserialize($data);
        
        $this->assertArrayHasKey('data', $data);
        $this->assertEquals(5,count($data['data']));
    }
    
    /** @test */
    public function all_active_spots_can_be_publically_listed_in_valid_geojson()
    {
        $activeSpotCount = 5;
        $spots = factory('App\Spot',$activeSpotCount)->create();
        
        // Create pending and rejected spots to ensure they don't show up in the geoJSON
        factory('App\Spot')->states('pending')->create();
        factory('App\Spot')->states('rejected')->create();

        $response = $this->json(
                'GET',
                "{$this->apiRoot}/spots",
                [],
                [
                    'Accept' => 'application/geo+json',
                ]
            )->assertStatus(200);

        $data = json_decode($response->getContent());
        $geoJson = GeoJson::jsonUnserialize($data);

        $this->assertInstanceOf('GeoJson\Feature\FeatureCollection', $geoJson);
        $this->assertEquals($activeSpotCount, $geoJson->count());

        // Make sure the data is correct
        $features = $geoJson->getFeatures();

        $props = $features[0]->getProperties();
        $this->assertEquals($spots->first()->price, $props['price']);
        
        $this->assertEquals(
            [$spots->first()->lng, $spots->first()->lat],
            $features[0]->getGeometry()->getCoordinates()
        );
    }
    
    /** @test */
    public function an_active_spot_can_be_publically_viewed()
    {
        $spot = factory('App\Spot')->create();

        $response = $this->json(
                'GET',
                "{$this->apiRoot}/spots/{$spot->id}"
            )->assertStatus(200)
            ->assertJsonStructure([
                'name',
                'address',
                'price',
                'pets',
                'sleeps',
                'baths'               
            ]);
            // );dd($response->decodeResponseJson());

        $data = json_decode($response->getContent(), true);
        $this->assertEquals($spot->name, $data['name']);

        // This should NOT be valid geoJSON
        $this->expectException(UnserializationException::class);
        GeoJson::jsonUnserialize($data);
    }

    /** @test */
    public function an_active_spot_can_be_publically_viewed_in_valid_geojson()
    {
        $spot = factory('App\Spot')->create();

        $response = $this->json(
                'GET',
                "{$this->apiRoot}/spots/{$spot->id}",
                [],
                [
                    'Accept' => 'application/geo+json',
                ]
            )->assertStatus(200);

        $data = json_decode($response->getContent());
        $geoJson = GeoJson::jsonUnserialize($data);

        $this->assertInstanceOf('GeoJson\Feature\Feature', $geoJson);
        
        $props = $geoJson->getProperties();
        $this->assertEquals($spot->price, $props['price']);
        
        $this->assertEquals(
            [$spot->lng,$spot->lat],
            $geoJson->getGeometry()->getCoordinates()
        );
    }

    /** @test */
    public function pending_spots_cannot_be_publically_viewed()
    {
        $spot = factory('App\Spot')->states('pending')->create();

        $this->json(
            'GET',
            "{$this->apiRoot}/spots/{$spot->id}"
        )->assertStatus(404);
    }

    public function pending_spots_can_be_viewed_with_auth()
    {

    }

    /** @test */
    public function rejected_spots_cannot_be_publically_viewed()
    {
        $spot = factory('App\Spot')->states('rejected')->create();

        $this->json(
            'GET',
            "{$this->apiRoot}/spots/{$spot->id}"
        )->assertStatus(404);
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
