<?php

function abreviarNome(string $nomeCompleto): string
{
    $artigos = ['da', 'de', 'do', 'das', 'dos', 'e'];

    $nomes = explode(' ', $nomeCompleto);

    $nomesFiltrados = array_filter($nomes, function($nome) use ($artigos) {
        return !in_array(strtolower($nome), $artigos);
    });

    $abreviado = array_slice($nomesFiltrados, 0, 2);

    return implode(' ', $abreviado);
}

function isAdministrador(): bool 
{
    return getSession()['auth']['id_perfil'] === 1;
}

function isGestor(): bool 
{
    return getSession()['auth']['id_perfil'] === 2;
}

function isOrientador(): bool 
{
    return getSession()['auth']['id_perfil'] === 3;
}

function getSala(int $id): object
{
    $querySala = DB::query('SELECT * FROM sala WHERE id = :id AND excluido_em IS NULL', [
        ':id' => $id
    ]);

    $queryDisponibilidade = DB::query('
        SELECT
            disponibilidade_sala.*, 
            dia_semana.nome AS nome_dia_semana
        FROM disponibilidade_sala 
        INNER JOIN dia_semana ON disponibilidade_sala.id_dia_semana = dia_semana.id
        WHERE 
            id_sala = :id 
        ORDER BY 
            id_dia_semana ASC, 
            hora_inicio ASC
    ', [
        ':id' => $id
    ]);
    
    $data = $querySala->fetch();
    $data->disponibilidades = $queryDisponibilidade->fetchAll();

    return $data;
}

function getAgendamento(int $id): object
{
    $queryAgendamento = DB::query('
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
            agendamento.id = :id 
            AND agendamento.excluido_em IS NULL
    ', [
        ':id' => $id
    ]);
    
    $data = $queryAgendamento->fetch();

    return $data;
}

function verificaDisponibilidadeSala(int $idSala, string $data, string $horaInicio, string $horaTermino): bool
{
    $chave = getdate(strtotime($data))['weekday'];

    $disponibilidade = DB::query('
        SELECT
            COUNT(*) AS total
        FROM sala 
        LEFT JOIN disponibilidade_sala ON disponibilidade_sala.id_sala = sala.id 
        LEFT JOIN dia_semana ON disponibilidade_sala.id_dia_semana = dia_semana.id
        WHERE 
            sala.id = :idSala
            AND sala.excluido_em IS NULL 
            AND dia_semana.chave = :chave
            AND TIME_TO_SEC(disponibilidade_sala.hora_inicio) <= TIME_TO_SEC(:horaInicio)
            AND TIME_TO_SEC(disponibilidade_sala.hora_termino) >= TIME_TO_SEC(:horaTermino)
    ', [
        ':idSala' => $idSala,
        ':chave' => $chave,
        ':horaInicio' => $horaInicio,
        ':horaTermino' => $horaTermino
    ])->fetch(); 

    return $disponibilidade->total > 0 ? true : false;
}