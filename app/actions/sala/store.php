<?php

$nome = input('post', 'nome');
$quantidadeMaquina = input('post', 'quantidade_maquina', 'integer');
$situacao = input('post', 'situacao');
$descricao = input('post', 'descricao');

if (
    !empty($nome)
    and !empty($quantidadeMaquina)
    and !empty($situacao)
    and !empty($descricao)
) {
    $result = DB::create('sala', [
        'nome' => $nome,
        'quantidade_maquina' => $quantidadeMaquina,
        'situacao' => $situacao,
        'descricao' => $descricao,
        'id_unidade' => getSession()['auth']['id_unidade'],
        'criado_em' => date('Y-m-d H:i:s')
    ]);

    if ($result !== false) {
        redirect('sala/cadastrar', [
            'success' => 'Cadastro realizado com sucesso!'
        ]);
    } else {
        redirect('sala/cadastrar', ['
            error' => 'Houve um erro ao tentar realizar o cadastro, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('sala/cadastrar', [
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}