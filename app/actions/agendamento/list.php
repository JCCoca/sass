<?php

require 'app/repositories/DataTableRepository.php';

$dataTable = new DataTableRepository('agendamento');

$dataTable
    ->select('
        agendamento.*, 
        sala.nome AS nome_sala,
        usuario.nome AS nome_usuario
    ')
    ->join('sala', 'agendamento.id_sala', '=', 'sala.id')
    ->join('usuario', 'agendamento.id_usuario', '=', 'usuario.id');

if (isOrientador()) {
    $dataTable->where('id_usuario', '=', getSession()['auth']['id']);
}

$dataTable->formatData(function($data){
    $formatData = [
        'id' => $data->id,
        'data' => date('d/m/Y', strtotime($data->data)),
        'hora_inicio' => date('H:i', strtotime($data->hora_inicio)),
        'hora_termino' => date('H:i', strtotime($data->hora_termino)),
        'turma' => $data->turma,
        'uc' => $data->uc,
        'justificativa' => $data->justificativa,
        'situacao' => $data->situacao,
        'nome_sala' => $data->nome_sala,
        'nome_usuario' => $data->nome_usuario,
        
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