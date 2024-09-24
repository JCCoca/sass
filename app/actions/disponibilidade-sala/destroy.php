<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $result = DB::delete('disponibilidade_sala', [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('sala', [
            'success' => 'Exclução realizada com sucesso!'
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