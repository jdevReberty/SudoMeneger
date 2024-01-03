<?php

use App\Enums\UsuarioEmpresaStatus;
use App\Enums\EmpresaTipoVinculo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_empresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_usuario");
            $table->foreignId("id_empresa");
            $table->foreignId("id_tipo_vinculo");
            $table->enum("status", array_column(UsuarioEmpresaStatus::cases(), 'name'));
            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign("id_usuario")->references("id")->on("users");
            $table->foreign("id_empresa")->references("id")->on("empresas");
            $table->foreign('id_tipo_vinculo')->references('id')->on('tipo_vinculo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_empresa');
    }
}
