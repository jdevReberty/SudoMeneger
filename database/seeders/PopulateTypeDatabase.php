<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateTypeDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $date = new DateTime();

        $countTipoEmpresa = 1;
        DB::table('tipo_empresa')->insert([
            ['id' => $countTipoEmpresa++, 'nome' => 'comercio', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoEmpresa++, 'nome' => 'servico', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoEmpresa++, 'nome' => 'comercio_servico', 'created_at' => $date, 'updated_at' => $date],
        ]);

        $countTipoVinculo = 1;
        DB::table('tipo_vinculo')->insert([
            ['id' => $countTipoVinculo++, 'nome' => 'titular', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoVinculo++, 'nome' => 'funcionario', 'created_at' => $date, 'updated_at' => $date],
        ]);

        $countTipoEnderecoContato = 1;
        DB::table('tipo_endereco_contato')->insert([
            ['id' => $countTipoEnderecoContato++, 'nome' => 'pessoal', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoEnderecoContato++, 'nome' => 'profissional', 'created_at' => $date, 'updated_at' => $date],
        ]);

        $countTipoDocumentacao = 1;
        DB::table('tipo_documentacao')->insert([
            ['id' => $countTipoDocumentacao++, 'nome' => 'venda', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoDocumentacao++, 'nome' => 'compra', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoDocumentacao++, 'nome' => 'pagamento_funcionario', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoDocumentacao++, 'nome' => 'declaracao', 'created_at' => $date, 'updated_at' => $date],
        ]);

        $countTipoMovimentacao = 1;
        DB::table('tipo_movimentacao')->insert([
            ['id' => $countTipoMovimentacao++, 'nome' => 'pagamento_funcionario', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoMovimentacao++, 'nome' => 'compra', 'created_at' => $date, 'updated_at' => $date],
            ['id' => $countTipoMovimentacao++, 'nome' => 'venda', 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
