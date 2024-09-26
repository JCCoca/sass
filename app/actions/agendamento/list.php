<?php

require 'app/repositories/DataTableRepository.php';

$dataTable = new DataTableRepository('agendamento');

$dataTable
    ->select('
        agendamento.*, 
        sala.nome AS nome_sala,
        orientador.nome AS nome_orientador,
        gestor.nome AS nome_gestor
    ')
    ->join('sala', 'agendamento.id_sala', '=', 'sala.id')
    ->join('usuario AS orientador', 'agendamento.id_orientador', '=', 'orientador.id')
    ->leftJoin('usuario AS gestor', 'agendamento.id_gestor', '=', 'gestor.id');

if (isOrientador()) {
    $dataTable->where('id_orientador', '=', getSession()['auth']['id']);
}

$dataTable->formatData(function($data){
    $formatData = [
        'id' => $data->id,
        'data' => date('d/m/Y', strtotime($data->data)),
        'hora_inicio' => date('H:i', strtotime($data->hora_inicio)),
        'hora_termino' => date('H:i', strtotime($data->hora_termino)),
        'curso' => $data->curso,
        'turma' => $data->turma,
        'uc' => $data->uc,
        'justificativa' => $data->justificativa,
        'situacao' => $data->situacao,
        'justificativa_recusa' => $data->justificativa_recusa,
        'nome_sala' => $data->nome_sala,
        'nome_orientador' => $data->nome_orientador,
        'nome_gestor' => $data->nome_gestor
    ];

    if ($data->situacao === 'Aguardando Confirmação') {
        if (isOrientador()) {
            $formatData['links'] = [
                'edit' => route('agendamento/editar', ['id' => $data->id]),
                'delete' => route('agendamento/excluir', ['id' => $data->id])
            ];
        } else {
            $formatData['links'] = [
                'confirm' => route('agendamento/confirmar', ['id' => $data->id]),
                'reject' => route('agendamento/recusar', ['id' => $data->id])
            ];
        }
    }

    return $formatData;
});

responseJson($dataTable->get());