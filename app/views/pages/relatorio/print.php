<?php

$idSala = input('get', 'id_sala', 'integer');
$dataInicio = input('get', 'data_inicio', 'date');
$dataTermino = input('get', 'data_termino', 'date');

$values = [
    ':dataInicio' => $dataInicio,
    ':dataTermino' => $dataTermino
];

$query = '';
if (!empty($idSala)) {
    $query .= " AND agendamento.id_sala = :idSala";
    $values[':idSala'] = $idSala;
}

$agendamentos = DB::query("
    SELECT
        agendamento.*, 
        sala.nome AS nome_sala,
        orientador.nome AS nome_orientador,
        orientador.email AS email_orientador,
        gestor.nome AS nome_gestor,
        gestor.email AS email_gestor
    FROM agendamento 
    INNER JOIN sala ON agendamento.id_sala = sala.id 
    INNER JOIN usuario AS orientador ON agendamento.id_orientador = orientador.id 
    LEFT JOIN usuario AS gestor ON agendamento.id_gestor = gestor.id 
    WHERE 
        agendamento.excluido_em IS NULL 
        AND agendamento.situacao = 'Aprovado'
        AND agendamento.data BETWEEN :dataInicio AND :dataTermino 
        {$query} 
    ORDER BY
        agendamento.data ASC,
        agendamento.hora_inicio ASC,
        sala.nome ASC
", $values)->fetchAll();

$sala = getSala($idSala);

renderPdf(pdfContent('agendamento/relatorio', 'Relatório de Agendamentos', [
    'agendamentos' => $agendamentos,
    'sala' => $sala,
    'dataInicio' => $dataInicio,
    'dataTermino' => $dataTermino
]));