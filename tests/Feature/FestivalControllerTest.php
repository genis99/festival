<?php

namespace Tests\Feature;

use App\Festival;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class FestivalControllerTest
 * @package Tests\Feature
 * @covers
 */
class FestivalControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function shows_no_classroom_at_init_state()
    {
        // PREPARE SKIP
        // EXECUTE
//        $this->assertTrue(true);
    $this->withoutExceptionHandling();
    $response = $this->json('GET','/api/v1/festival');
    $response->assertSuccessful();
    $festivalJSON = $response->getContent();
    $festival = json_decode($festivalJSON);
    $this->assertEquals($festivalJSON,'[]');
    $this->assertCount(0,$festival);


    }

    /**
     * @test
     */
    public function shows_classroom_ok()
    {
        // 1 PREPARE -> SEED DATABASE WITH

        //MODELS
        Festival::create([
            'name' => '2DAM'
        ]);

        Festival::create([
            'name' => '2ASIX'
        ]);

        Festival::create([
            'name' => '2SMX'
        ]);
        //EXECUTE
        $response = $this->json('GET','/api/v1/festival');
        $response->assertSuccessful();
        $festivalJSON = $response->getContent();
        $festival = json_decode($festivalJSON);
        $this->assertCount(3,$festival);
        $response->assertJsonCount(3);
        $this->assertEquals($festival[0]->name,'2DAM');
        $this->assertEquals($festival[1]->name,'2ASIX');
        $this->assertEquals($festival[2]->name,'2SMX');


    }
}
