<?php

use App\Enums\{
    EmpresaTipoVinculo, 
    ServicoStatus, 
    TipoContato,
    TipoDocumento,
    TipoEmpresa, 
    TipoEndereco,
    TipoMovimentacao,
    UsuarioEmpresaStatus
};

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

if(!function_exists('getStatusServico')) {
    function getStatusServico(string $name) {
        return ServicoStatus::fromValue($name);
    }
}

if(!function_exists('getTipoDocumento')) {
    function getTipoDocumento(string $name) {
        return TipoDocumento::fromValue($name);
    }
}

if(!function_exists('getTipoMovimentacao')) {
    function getTipoMovimentacao(string $name) {
        return TipoMovimentacao::fromValue($name);
    }
}

