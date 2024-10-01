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

function getUsuario(int|string|null $value): ?object 
{
    $queryUsuario = DB::query('
        SELECT * FROM usuario 
        WHERE 
            (
                id = :value 
                OR email = :value
            )
            AND excluido_em IS NULL
    ', [
        ':value' => $value
    ]);

    if ($queryUsuario->rowCount() === 1) {
        return $queryUsuario->fetch();
    } else {
        return null;
    }
}

function getRedefinicaoSenha(?string $token): ?object
{
    $queryRedefinicaoSenha = DB::query('
        SELECT * FROM redefinicao_senha 
        WHERE 
            token = :token 
    ', [
        ':token' => $token
    ]);

    if ($queryRedefinicaoSenha->rowCount() === 1) {
        return $queryRedefinicaoSenha->fetch();
    } else {
        return null;
    }
}

function getGestoresUnidade(?int $idUnidade): ?array
{
    $queryGestores = DB::query('
        SELECT 
            id, 
            nome AS name, 
            email 
        FROM usuario 
        WHERE 
            id_perfil = 2 
            AND id_unidade = :idUnidade 
            AND excluido_em IS NULL
    ', [
        ':idUnidade' => $idUnidade
    ]);

    if ($queryGestores->rowCount() > 0) {
        return $queryGestores->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return null;
    }
}

function getSala(?int $id): ?object
{
    $querySala = DB::query('
        SELECT * FROM sala 
        WHERE 
            id = :id 
            AND excluido_em IS NULL
    ', [
        ':id' => $id
    ]);

    $queryDisponibilidade = DB::query('
        SELECT
            disponibilidade_sala.*, 
            dia_semana.nome AS nome_dia_semana
        FROM disponibilidade_sala 
        INNER JOIN dia_semana ON disponibilidade_sala.id_dia_semana = dia_semana.id
        WHERE 
            disponibilidade_sala.id_sala = :id 
        ORDER BY 
            disponibilidade_sala.id_dia_semana ASC, 
            disponibilidade_sala.hora_inicio ASC
    ', [
        ':id' => $id
    ]);
     
    if ($querySala->rowCount() === 1) {
        $data = $querySala->fetch();
        $data->disponibilidades = $queryDisponibilidade->fetchAll();
    
        return $data;
    } else {
        return null;
    }
}

function getAgendamento(?int $id): ?object
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
    ', [
        ':id' => $id
    ]);

    if ($queryAgendamento->rowCount() === 1) {
        return $queryAgendamento->fetch();
    } else {
        return null;
    }
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

    return $disponibilidade->total > 0 ? false : true;
}

function verificaDisponibilidadeAgendamento(int $idSala, string $data, string $horaInicio, string $horaTermino): bool 
{
    $disponibilidade = DB::query("
        SELECT
            COUNT(*) AS total
        FROM agendamento
        WHERE
            agendamento.excluido_em IS NULL
            AND agendamento.situacao = 'Aprovado'
            AND agendamento.id_sala = :idSala 
            AND agendamento.data = :data  
            AND (
                :horaInicio BETWEEN agendamento.hora_inicio AND agendamento.hora_termino 
                OR :horaTermino BETWEEN agendamento.hora_inicio AND agendamento.hora_termino 
                OR agendamento.hora_inicio BETWEEN :horaInicio AND :horaTermino 
                OR agendamento.hora_termino BETWEEN :horaInicio AND :horaTermino 
            )
    ", [
        ':idSala' => $idSala,
        ':data' => $data,
        ':horaInicio' => $horaInicio,
        ':horaTermino' => $horaTermino
    ])->fetch(); 

    return $disponibilidade->total > 0 ? true : false;
}

function verificaHorarioLimite(string $datetime): bool
{
    return (strtotime($datetime) - time()) > 3600;
}