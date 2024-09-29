<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $result = DB::update('sala', [
        'excluido_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('sala', [
            'success' => 'Exclusão realizada com sucesso!'
        ]);
    } else {
        redirect('sala', [
            'error' => 'Houve um erro ao tentar realizar a exclusão, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('sala', [
        'error' => 'Por favor, informe o ID!'
    ]);
}