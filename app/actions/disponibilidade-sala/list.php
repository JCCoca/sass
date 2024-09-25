<?php

require 'app/repositories/DataTableRepository.php';

$idSala = input('get', 'id_sala', 'integer');

$dataTable = new DataTableRepository('disponibilidade_sala');

$dataTable
    ->select('
        disponibilidade_sala.*, 
        dia_semana.nome AS nome_dia_semana
    ')
    ->join('dia_semana', 'disponibilidade_sala.id_dia_semana', '=', 'dia_semana.id')
    ->where('id_sala', '=', $idSala)
    ->orderBy('id_dia_semana')
    ->orderBy('hora_inicio');

$dataTable->softDelete(false);

$dataTable->formatData(function($data){
    return [
        'id' => $data->id,
        'hora_inicio' => date('H:i', strtotime($data->hora_inicio)),
        'hora_termino' => date('H:i', strtotime($data->hora_termino)),
        'nome_dia_semana' => $data->nome_dia_semana,
        'links' => [
            'edit' => route('sala/disponibilidade/editar', ['id' => $data->id, 'id_sala' => $data->id_sala]),
            'delete' => route('sala/disponibilidade/excluir', ['id' => $data->id, 'id_sala' => $data->id_sala])
        ],
    ];
});

responseJson($dataTable->get());