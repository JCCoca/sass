<?php

$id = input('get', 'id', 'integer');
$nome = input('post', 'nome');
$quantidadeMaquina = input('post', 'quantidade_maquina', 'integer');
$situacao = input('post', 'situacao');
$descricao = input('post', 'descricao');

if (
    !empty($id)
    and !empty($nome)
    and !empty($quantidadeMaquina)
    and !empty($situacao)
    and !empty($descricao)
) {
    $result = DB::update('sala', [
        'nome' => $nome,
        'quantidade_maquina' => $quantidadeMaquina,
        'situacao' => $situacao,
        'descricao' => $descricao,
        'atualizado_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('sala/editar', [
            'id' => $id,
            'success' => 'Edição realizada com sucesso!'
        ]);
    } else {
        redirect('sala/editar', [
            'id' => $id,
            'error' => 'Houve um erro ao tentar realizar a edição, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('sala/editar', [
        'id' => $id,
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}