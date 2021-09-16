<?php

namespace Database\Seeders;

use App\Models\Favored;
use Illuminate\Database\Seeder;

class FavoredSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //CRIANDO FAVORECIDOS COM DADOS BANCÁRIOS QUE VÃO PASSAR NA VALIDAÇÃO
            $this->createFavoredSeed([
                'name'          => 'Bárbara da Silva Silveira Fontes',
                'document'      => '2193523912',
                'email'         => 'barbaradasilva@hotmail.com',
                'bank'          => '237',
                'agency'        => '0814',
                'agencyDigit'   => '0',
                'account'       => '01002713',
                'accountDigit'  => '9',
                'accountType'   => 'CONTA_CORRENTE',
                'valid'         => true
            ]);

        $this->createFavoredSeed([
            'name'          => 'Weslei Ferreira da silva',
            'document'      => '08972934950',
            'email'         => 'weslei@hotmail.com',
            'bank'          => '104',
            'agency'        => '123',
            'agencyDigit'   => 'X',
            'account'       => '01002713',
            'accountDigit'  => '9',
            'accountType'   => 'CONTA_POUPANCA',
            'valid'         => false
        ]);

        $this->createFavoredSeed([
            'name'          => 'Juninho da silva',
            'document'      => '2193523912',
            'email'         => 'juninho@hotmail.com',
            'bank'          => '756',
            'agency'        => '1000',
            'agencyDigit'   => '',
            'account'       => '01002713',
            'accountDigit'  => '9',
            'accountType'   => 'CONTA_CORRENTE',
            'valid'         => true
        ]);

        $this->createFavoredSeed([
            'name'          => 'Silva e Silva',
            'document'      => '27084098000169',
            'email'         => 'silva@hotmail.com',
            'bank'          => '237',
            'agency'        => '0814',
            'agencyDigit'   => '0',
            'account'       => '01002713',
            'accountDigit'  => '9',
            'accountType'   => 'CONTA_CORRENTE',
            'valid'         => true
        ]);
        //

        Favored::factory()
            ->count(500)
            ->create();
    }

    function createFavoredSeed($data){
        try{
            Favored::create($data);
        }catch(\Exception $e){
            throw new \Exception('Erro ao criar favorecido: '.$e->getMessage());
        }
    }
}
