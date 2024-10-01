<?php

require 'app/repositories/DataTableRepository.php';

$dataTable = new DataTableRepository('sala');

$dataTable
    ->select('
        sala.*, 
        unidade.nome AS nome_unidade
    ')
    ->join('unidade', 'sala.id_unidade', '=', 'unidade.id')
    ->where('id_unidade', '=', getSession()['auth']['id_unidade']);

$dataTable->formatData(function($data){
    $formatData = [
        'id' => $data->id,
        'nome' => $data->nome,
        'quantidade_maquina' => $data->quantidade_maquina,
        'descricao' => $data->descricao,
        'situacao' => $data->situacao,
        'nome_unidade' => $data->nome_unidade
    ];

    if (isGestor()) {
        $formatData['links'] = [
            'detail' => route('sala/detalhar', ['id' => $data->id]),
            'edit' => route('sala/editar', ['id' => $data->id]),
            'delete' => route('sala/excluir', ['id' => $data->id])
        ];
    } else {
        $formatData['links'] = [
            'detail' => route('sala/detalhar', ['id' => $data->id])
        ];
    }

    return $formatData;
});

responseJson($dataTable->get());