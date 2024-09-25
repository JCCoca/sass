<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $result = DB::update('agendamento', [
        'situacao' => 'Recusado',
        'atualizado_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('agendamento', [
            'success' => 'Agendamento recusado com sucesso!!'
        ]);
    } else {
        redirect('agendamento', [
            'error' => 'Houve um erro ao tentar realizar esta ação, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('agendamento', [
        'error' => 'Por favor, informe o ID!'
    ]);
}