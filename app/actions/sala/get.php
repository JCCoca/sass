<?php 

$id = input('get', 'id', 'integer');

if (!empty($id)) {
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

    responseJson([
        'data' => $data
    ]);
} else {
    responseJson([
        'error' => 'Por favor, informe o ID da sala!'
    ]);
}