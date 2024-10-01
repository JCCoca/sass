<?php

$idSala = input('get', 'id_sala', 'integer');
$dataInicio = input('get', 'data_inicio', 'date');
$dataTermino = input('get', 'data_termino', 'date');

$query = '';
if (!empty($idSala)) {
    $query .= " AND agendamento.id_sala = {$idSala}";
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
", [
    ':dataInicio' => $dataInicio,
    ':dataTermino' => $dataTermino
])->fetchAll();

renderPdf(pdfContent('relatorio', 'Relatório de Agendamento de Sala', [
    'agendamentos' => $agendamentos,
    'idSala' => $idSala,
    'dataInicio' => $dataInicio,
    'dataTermino' => $dataTermino
]));