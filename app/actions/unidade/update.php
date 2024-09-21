<?php

$id = input('get', 'id', 'integer');
$nome = input('post', 'nome');
$idCidade = input('post', 'id_cidade', 'integer');
$idEstado = input('post', 'id_estado', 'integer');

if (
    !empty($id)
    and !empty($nome)
    and !empty($idCidade)
    and !empty($idEstado)
) {
    $result = DB::update('unidade', [
        'nome' => $nome,
        'id_cidade' => $idCidade,
        'id_estado' => $idEstado,
        'atualizado_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('unidade/editar', [
            'id' => $id,
            'success' => 'Edição realizada com sucesso!'
        ]);
    } else {
        redirect('unidade/editar', [
            'id' => $id,
            'error' => 'Houve um erro ao tentar realizar a edição, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('unidade/editar', [
        'id' => $id,
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}