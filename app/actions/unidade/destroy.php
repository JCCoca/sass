<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $result = DB::update('unidade', [
        'excluido_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('unidade', [
            'success' => 'Exclusão realizada com sucesso!'
        ]);
    } else {
        redirect('unidade', [
            'error' => 'Houve um erro ao tentar realizar a exclusão, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('unidade', [
        'error' => 'Por favor, informe o ID!'
    ]);
}