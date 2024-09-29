<?php

$id = input('get', 'id', 'integer');
$idSala = input('get', 'id_sala', 'integer');

if (!empty($id) and !empty($idSala)) {
    $result = DB::delete('disponibilidade_sala', [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('sala/detalhar', [
            'id' => $idSala,
            'success' => 'Exclusão realizada com sucesso!'
        ]);
    } else {
        redirect('sala/detalhar', [
            'id' => $idSala,
            'error' => 'Houve um erro ao tentar realizar a exclusão, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('sala/detalhar', [
        'id' => $idSala,
        'error' => 'Por favor, informe o ID!'
    ]);
}