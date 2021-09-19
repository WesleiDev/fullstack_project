<?php

namespace Tests\Feature;

use App\Models\Favored;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoredTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function get_favored_api_teste()
    {
        $response = $this->get('/api/favored');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function post_favored_api_teste()
    {
        $data = [
            'name'          => 'TESTE API',
            'document'      => '2193523912',
            'email'         => 'barbaradasilva@hotmail.com',
            'bank'          => '237',
            'agency'        => '0814',
            'agencyDigit'   => '0',
            'account'       => '01002713',
            'accountDigit'  => '9',
            'accountType'   => 'CONTA_CORRENTE',
            'valid'         => true
        ];

        $response = $this->post('/api/favored', $data);

        $response->assertStatus(200)
                  ->assertJson([
                      'error' => false
                  ]);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function put_favored_api_teste()
    {
        $favored = Favored::all()->first();

        $data = [
            'name'          => 'TESTE API UPDATE',
            'document'      => '2193523912',
            'email'         => 'barbaradasilva@hotmail.com',
            'bank'          => '237',
            'agency'        => '0814',
            'agencyDigit'   => '0',
            'account'       => '01002713',
            'accountDigit'  => '9',
            'accountType'   => 'CONTA_CORRENTE',
            'valid'         => true
        ];

        $response = $this->put('/api/favored/'.$favored->id, $data);

        $response->assertStatus(200)
            ->assertJson([
                'error' => false
            ]);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function delete_favored_api_teste()
    {
        $favored = Favored::all()->first();

        $response = $this->delete('/api/favored/'.$favored->id);

        $response->assertStatus(200)
            ->assertJson([
                'error' => false
            ]);
    }
}
