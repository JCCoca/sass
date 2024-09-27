<?php 

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $data = getAgendamento($id);

    responseJson([
        'data' => $data
    ]);
} else {
    responseJson([
        'error' => 'Por favor, informe o ID do agendamento!'
    ]);
}