<?php

require 'app/repositories/DataTableRepository.php';

$dataTable = new DataTableRepository('usuario');

$dataTable
    ->select('
        usuario.*, 
        perfil.nome AS nome_perfil,
        unidade.nome AS nome_unidade
    ')
    ->join('perfil', 'usuario.id_perfil', '=', 'perfil.id')
    ->join('unidade', 'usuario.id_unidade', '=', 'unidade.id');

if (isGestor()) {
    $dataTable
        ->where('id_unidade', '=', getSession()['auth']['id_unidade'])
        ->where('id_perfil', '<>', 1);
}

$dataTable->formatData(function($data){
    return [
        'id' => $data->id,
        'nome' => $data->nome,
        'email' => $data->email,
        'sexo' => $data->sexo,
        'funcao' => $data->funcao,
        'nome_perfil' => $data->nome_perfil,
        'nome_unidade' => $data->nome_unidade,
        'links' => [
            'edit' => route('usuario/editar', ['id' => $data->id]),
            'delete' => route('usuario/excluir', ['id' => $data->id])
        ],
    ];
});

responseJson($dataTable->get());