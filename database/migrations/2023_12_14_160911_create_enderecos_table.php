<?php

use App\Enums\TipoEndereco;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_usuario")->nullable();
            $table->foreignId("id_empresa")->nullable();
            $table->enum("tipo_endereco", array_column(TipoEndereco::cases(), 'name'));
            $table->string("logradouro")->nullable();
            $table->string("numero")->nullable();
            $table->string("bairro")->nullable();
            $table->string("cep")->nullable();
            $table->string("cidade")->nullable();
            $table->string("estado")->nullable();
  
            $table->timestampsTz();

            $table->foreign("id_usuario")->references("id")->on("users");
            $table->foreign("id_empresa")->references("id")->on("empresas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
