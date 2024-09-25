<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $result = DB::update('agendamento', [
        'excluido_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('agendamento', [
            'success' => 'Exclução realizada com sucesso!'
        ]);
    } else {
        redirect('agendamento', [
            'error' => 'Houve um erro ao tentar realizar a exclusão, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('agendamento', [
        'error' => 'Por favor, informe o ID!'
    ]);
}