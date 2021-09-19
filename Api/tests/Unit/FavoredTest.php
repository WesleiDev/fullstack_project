<?php

namespace Tests\Unit;

use App\Models\Favored;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FavoredTest extends TestCase
{


    /**
     * @test
     * Testa se o registro está sendo incluso corretamente no banco de dados
     */
    public function create_favored_teste(){

        $data = [
            'name'          => 'TESTE',
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

        $favored = Favored::create($data);

        $this->assertNotEmpty($favored);
    }

    /**
     * @test
     *
     */
    function delete_favored_teste(){
        $favored = Favored::all()->first;
        $deleted = $favored->delete();

        $this->assertNotEmpty($deleted);
    }

    /**
     * @test
     *
     */
    function update_favored_teste(){
        $data = [
            'name'          => 'TESTE',
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

        $favored = Favored::all()->first;

        try{
            $favored->update($data);
            $updated = true;
        }catch(\Exception $e){
            $updated = false;
        }

        $this->assertTrue($updated);
    }
}
