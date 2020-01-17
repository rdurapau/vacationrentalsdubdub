<?php

namespace Tests\Feature;

use App\BaseSpot;
use App\Spot;
use App\EditToken;
use App\ModerationStatus;
use App\Helpers\RandomCoordinates;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTokenTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function setUp(): void 
    {
        parent::setUp();

        // $this->faker = Faker::class;
    }
    
    /** @test */
    public function when_a_spot_is_created_an_edit_token_is_also_created()
    {
        $spot = Spot::create(
            $this->getFakeSpotData()
        );

        $this->assertDatabaseHas('edit_tokens',[
            'spot_id' => $spot->id
        ]);
        $this->assertEquals(1,EditToken::count());
    }

    /** @test */
    public function an_edit_token_email_can_be_resent()
    {
        Mail::fake();

        $spot = factory('App\Spot')->create();
        $token = $spot->editToken;
        $token->resendEmail();;
        
        Mail::assertSent(\App\Mail\SpotEditUrl::class, function ($mail) use ($spot, $token) {
            return (($mail->spot->id === $spot->id) && ($mail->token->id === $token->id));
        });
    }

    // /** @test */
    // public function a_spot_can_be_edited_with_the_correct_edit_url()
    // {
    //     $spot = Spot::create($this->getFakeSpotData());

    //     $this->get($spot->edit_url)
    //         ->assertStatus(200);
        
    //     $spotData = $spot->toArray();
    //     $spotData['address1'] = '1600 Pennsylvania Ave';
    //     $spotData['edit_token'] = $spot->editToken->token;

    //     $r = $this->patch("/spots/{$spot->id}", $spotData)
    //         ->assertRedirect();
    //         // ;dd($r->decodeResponseJson());
        
    //     $this->assertDatabaseHas('spots', [
    //         'id' => $spot->id,
    //         'address1' => '1600 Pennsylvania Ave'
    //     ]);
    // }

    // /** @test */
    // public function a_spot_cannot_be_edited_without_the_correct_edit_token()
    // {
    //     $spot = Spot::create($this->getFakeSpotData());
    //     $altSpot = factory('App\Spot')->create();

    //     $this->get($spot->edit_url)
    //         ->assertStatus(200);
        
    //     $spotData = $spot->toArray();
    //     $spotData['address1'] = '350 Fifth Avenue';
    //     $spotData['edit_token'] = $altSpot->editToken->token;

    //     $r = $this->patch("/spots/{$spot->id}", $spotData)
    //         ->assertSessionHasErrors('edit_token');
    //         // ;dd($r->decodeResponseJson());
        
    //     $this->assertDatabaseMissing('spots', [
    //         'id' => $spot->id,
    //         'address1' => '350 Fifth Avenue'
    //     ]);

    //     $this->assertDatabaseHas('spots', [
    //         'id' => $spot->id,
    //         'address1' => $spot->address1
    //     ]);
    // }

    public function playground()
    {
        $spot = factory('App\Spot')->create();
        $amenity_ids = DB::table('amenity_spot')
            ->select('amenity_id')
            ->where('spot_id','=',$spot->id)
            ->get();

        $json = json_decode(json_encode($amenity_ids), true);
        $arr = [];
        foreach($json as $j) {
            $arr[] = $j['amenity_id'];
        }
        dd($arr);

        
        $result = DB::table('amenities')
            ->leftJoin('amenity_spot', 'amenities.id', '=', 'amenity_spot.amenity_id')
            ->leftJoin('spots', 'spots.id', '=', 'amenity_spot.spot_id')
            ->select('amenities.*', 'amenity_spot.*')
            ->get();

        dd($result);
        
    }
}
