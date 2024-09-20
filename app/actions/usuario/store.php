<?php

$nome = input('post', 'nome');
$email = input('post', 'email', 'email');
$senha = input('post', 'senha');
$sexo = input('post', 'sexo');
$funcao = input('post', 'funcao');
$idPerfil = input('post', 'id_perfil', 'integer');
$idUnidade = input('post', 'id_unidade', 'integer');

if (
    !empty($nome)
    and !empty($email)
    and !empty($senha)
    and !empty($sexo)
    and !empty($funcao)
    and !empty($idPerfil)
    and !empty($idUnidade)
) {
    $result = DB::create('usuario', [
        'nome' => $nome,
        'email' => $email,
        'senha' => password_hash($senha, PASSWORD_BCRYPT),
        'sexo' => $sexo,
        'funcao' => $funcao,
        'id_perfil' => $idPerfil,
        'id_unidade' => $idUnidade,
        'criado_em' => date('Y-m-d H:i:s')
    ]);

    if ($result !== false) {
        redirect('usuario/cadastrar', [
            'success' => 'Cadastro realizado com sucesso!'
        ]);
    } else {
        redirect('usuario/cadastrar', ['
            error' => 'Houve um erro ao tentar realizar o cadastro, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('usuario/cadastrar', [
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}