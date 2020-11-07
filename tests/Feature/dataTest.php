<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class dataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */

    public function home_page_test()
    {
        $response = $this->get('/');
      


       

        $response->assertStatus(200);
    }
    public function getting_data_from_api_test()
    {
        $this->json('get', '/https://content.guardianapis.com/search?', ['api-key' => env("GUARDIAN_API_KEY", ""),
        'section' =>'movies'])
             ->seeJson([
                 'status' => 'ok',
             ]);
     
    }
}
