<?php

use App\Enums\TipoDocumento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empresa')->nullable();
            $table->foreignId('id_servico')->nullable();
            $table->foreignId("id_tipo_documentacao");
            $table->text("path")->nullable();
            $table->timestampsTz();

            $table->foreign("id_empresa")->references("id")->on("empresas");
            $table->foreign("id_servico")->references("id")->on("servicos");
            $table->foreign('id_tipo_documentacao')->references('id')->on('tipo_documentacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentacaos');
    }
}
