<?php

use App\Enums\ServicoStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empresa');
            $table->string('orcamento_previo');
            $table->string('orcamento_final')->nullable();
            $table->enum("status", array_column(ServicoStatus::cases(), 'name'));
            $table->text('descricao')->nullable();
            $table->timestampsTz();
             
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
        Schema::dropIfExists('servicos');
    }
}
