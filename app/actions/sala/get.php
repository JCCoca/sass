<?php 

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $data = getSala($id);

    responseJson([
        'data' => $data
    ]);
} else {
    responseJson([
        'error' => 'Por favor, informe o ID da sala!'
    ]);
}