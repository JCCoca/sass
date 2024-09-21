<?php 

$idEstado = input('get', 'id_estado', 'integer');

if (!empty($idEstado)) {
    $queryCidade = DB::query('SELECT * FROM cidade WHERE id_estado = :id ORDER BY nome ASC', [
        ':id' => $idEstado
    ]);

    responseJson([
        'total' => $queryCidade->rowCount(),
        'data' => $queryCidade->fetchAll()
    ]);
} else {
    responseJson([
        'error' => 'Por favor, informe o ID do estado!'
    ]);
}