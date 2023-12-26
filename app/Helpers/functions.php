<?php

use App\Enums\EmpresaTipoVinculo;
use App\Enums\TipoContato;
use App\Enums\TipoEmpresa;
use App\Enums\TipoEndereco;
use App\Enums\UsuarioEmpresaStatus;

if(!function_exists('getStatusTipoVinculoEmpresa')) {
    function getStatusTipoVinculoEmpresa(string $name) {
        return EmpresaTipoVinculo::fromValue($name);
    }
}

if(!function_exists('getStatusTipoContato')) {
    function getStatusTipoContato(string $name) {
        return TipoContato::fromValue($name);
    }
}

if(!function_exists('getStatusTipoEmpresa')) {
    function getStatusTipoEmpresa(string $name) {
        return TipoEmpresa::fromValue($name);
    }
}

if(!function_exists('getStatusTipoEndereco')) {
    function getStatusTipoEndereco(string $name) {
        return TipoEndereco::fromValue($name);
    }
}

if(!function_exists('getStatusUsuarioEmpresa')) {
    function getStatusUsuarioEmpresa(string $name) {
        return UsuarioEmpresaStatus::fromValue($name);
    }
}