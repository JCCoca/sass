<?php

require 'app/repositories/DataTableRepository.php';

$situacao = input('get', 'situacao');
$data = input('get', 'data', 'date');
$idUnidade = input('get', 'id_unidade', 'integer');

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

if (isOrientador() and empty($idUnidade)) {
    $dataTable->where('agendamento.id_orientador', '=', getSession()['auth']['id']);
}
if (isGestor()) {
    $dataTable->where('sala.id_unidade', '=', getSession()['auth']['id_unidade']);
}
if (!empty($situacao)) {
    $dataTable->where('agendamento.situacao', '=', $situacao);
}
if (!empty($data)) {
    $dataTable->where('agendamento.data', '>=', $data);
}
if (!empty($idUnidade)) {
    $dataTable->where('sala.id_unidade', '=', $idUnidade);
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

    if (isOrientador()) {
        $formatData['links'] = [
            'edit' => ($data->situacao === 'Aguardando Confirmação') ? route('agendamento/editar', ['id' => $data->id]) : null,
            'delete' => verificaHorarioLimite($data->data.' '.$data->hora_inicio) ? route('agendamento/excluir', ['id' => $data->id]) : null
        ];
    } else {
        if ($data->situacao === 'Aguardando Confirmação') {
            $formatData['links'] = [
                'confirm' => route('agendamento/confirmar', ['id' => $data->id]),
                'reject' => route('agendamento/recusar', ['id' => $data->id])
            ];
        }
    }

    return $formatData;
});

responseJson($dataTable->get());