<?php

use App\Enums\TipoMovimentacao;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empresa')->nullable();
            $table->foreignId('id_servico')->nullable();
            $table->foreignId('id_usuario')->nullable();
            $table->enum('tipo_movimentacao', array_column(TipoMovimentacao::cases(), 'name'));
            $table->integer('valor');
            
            $table->timestampsTz();

            $table->foreign("id_empresa")->references("id")->on("empresas");
            $table->foreign("id_servico")->references("id")->on("servicos");
            $table->foreign("id_usuario")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentacaos');
    }
}
