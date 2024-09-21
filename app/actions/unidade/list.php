<?php

require 'app/repositories/DataTableRepository.php';

$dataTable = new DataTableRepository('unidade');

$dataTable
    ->select('
        unidade.*, 
        cidade.nome AS nome_cidade,
        estado.nome AS nome_estado
    ')
    ->join('cidade', 'unidade.id_cidade', '=', 'cidade.id')
    ->join('estado', 'unidade.id_estado', '=', 'estado.id');

$dataTable->formatData(function($data){
    return [
        'id' => $data->id,
        'nome' => $data->nome,
        'nome_cidade' => $data->nome_cidade,
        'nome_estado' => $data->nome_estado,
        'links' => [
            'edit' => route('unidade/editar', ['id' => $data->id]),
            'delete' => route('unidade/excluir', ['id' => $data->id])
        ],
    ];
});

responseJson($dataTable->get());