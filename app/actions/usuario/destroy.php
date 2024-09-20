<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $result = DB::update('usuario', [
        'excluido_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('usuario', [
            'success' => 'Exclução realizada com sucesso!'
        ]);
    } else {
        redirect('usuario', [
            'error' => 'Houve um erro ao tentar realizar a exclusão, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('usuario', [
        'error' => 'Por favor, informe o ID!'
    ]);
}