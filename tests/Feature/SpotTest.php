<?php

namespace Tests\Feature;

use App\Spot;
use App\BaseSpot;
use App\ModerationStatus;

use GeoJson\GeoJson;
use GeoJson\Exception\UnserializationException;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** @group api */
class SpotTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function setUp() : void 
    {
        parent::setUp();

        // Storage::fake('testing');
    }

    /** @test */
    public function all_active_spots_can_be_publically_listed()
    {
        $activeSpotCount = 5;
        factory('App\Spot',$activeSpotCount)->create();
        
        // Create pending and rejected spots to ensure they don't show up in the geoJSON
        factory('App\Submission')->create();
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
        factory('App\Submission')->create();
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
        // dd($data);

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
                'desc',
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
        $spot = factory('App\Submission')->create();

        $this->json(
            'GET',
            "{$this->apiRoot}/spots/{$spot->id}"
        )->assertStatus(404);
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

    /** @test */
    public function a_spot_can_be_edited_with_the_correct_edit_token()
    {
        // $spot = Spot::create($this->getFakeSpotData());
        $spot = factory('App\Submission')->create();

        $this->get($spot->edit_url)
            ->assertStatus(200);
        
        $spotData = $spot->toArray();
        $spotData['address1'] = '1600 Pennsylvania Ave';
        $spotData['email_confirmation'] = $spot->email;
        $spotData['edit_token'] = $spot->editToken->token;

        $r = $this->json(
            'PATCH',
            "{$this->apiRoot}/spots/{$spot->id}",
            $spotData
        )->assertStatus(204);
        // );dd($r->decodeResponseJson());
        
        $this->assertDatabaseHas('spots', [
            'id' => $spot->id,
            'address1' => '1600 Pennsylvania Ave'
        ]);
    }

    /** @test */
    public function a_spot_cannot_be_edited_without_the_correct_edit_token()
    {
        // $spot = Spot::create($this->getFakeSpotData());
        $spot = factory('App\Submission')->create();
        $altSpot = factory('App\Spot')->create();

        // dd($spot->edit_url);

        $r = $this->get($spot->edit_url)
            ->assertStatus(200);
        // ;dd($r->decodeResponseJson());
        
        $spotData = $spot->toArray();
        $spotData['address1'] = '350 Fifth Avenue';
        $spotData['email_confirmation'] = $spot->email;
        $spotData['edit_token'] = $altSpot->editToken->token;

        // $r = $this->patch("/spots/{$spot->id}", $spotData)
        //     ->assertSessionHasErrors('edit_token');
        //     // ;dd($r->decodeResponseJson());

        $r = $this->json(
            'PATCH',
            "{$this->apiRoot}/spots/{$spot->id}",
            $spotData
        )->assertJsonValidationErrors('edit_token');
        // );dd($r->decodeResponseJson());
        
        $this->assertDatabaseMissing('spots', [
            'id' => $spot->id,
            'address1' => '350 Fifth Avenue'
        ]);

        $this->assertDatabaseHas('spots', [
            'id' => $spot->id,
            'address1' => $spot->address1
        ]);
    }

    public function rejected_spots_can_be_viewed_with_auth()
    {

    }

    public function pending_spots_can_be_viewed_with_auth()
    {

    }

}
