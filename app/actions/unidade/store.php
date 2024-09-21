<?php

$nome = input('post', 'nome');
$idCidade = input('post', 'id_cidade', 'integer');
$idEstado = input('post', 'id_estado', 'integer');

if (
    !empty($nome)
    and !empty($idCidade)
    and !empty($idEstado)
) {
    $result = DB::create('unidade', [
        'nome' => $nome,
        'id_cidade' => $idCidade,
        'id_estado' => $idEstado,
        'criado_em' => date('Y-m-d H:i:s')
    ]);

    if ($result !== false) {
        redirect('unidade/cadastrar', [
            'success' => 'Cadastro realizado com sucesso!'
        ]);
    } else {
        redirect('unidade/cadastrar', ['
            error' => 'Houve um erro ao tentar realizar o cadastro, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('unidade/cadastrar', [
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}