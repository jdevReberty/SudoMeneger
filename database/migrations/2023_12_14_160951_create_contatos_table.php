<?php

use App\Enums\TipoContato;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_usuario")->nullable();
            $table->foreignId("id_empresa")->nullable();
            $table->foreignId("id_tipo_endereco_contato");
            $table->string("telefone")->nullable();
            $table->string("email")->nullable();
            $table->string("celular")->nullable();
            $table->string("whatsapp")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->string("linkedin")->nullable();
            $table->timestampsTz();

            $table->foreign("id_usuario")->references("id")->on("users");
            $table->foreign("id_empresa")->references("id")->on("empresas");
            $table->foreign('id_tipo_endereco_contato')->references('id')->on('tipo_endereco_contato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatos');
    }
}
