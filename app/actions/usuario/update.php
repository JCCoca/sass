<?php

$id = input('get', 'id', 'integer');
$nome = input('post', 'nome');
$email = input('post', 'email', 'email');
$senha = input('post', 'senha');
$sexo = input('post', 'sexo');
$funcao = input('post', 'funcao');
$idPerfil = input('post', 'id_perfil', 'integer');
$idUnidade = input('post', 'id_unidade', 'integer');

if (
    !empty($id)
    and !empty($nome)
    and !empty($email)
    and !empty($sexo)
    and !empty($funcao)
    and !empty($idPerfil)
    and !empty($idUnidade)
) {
    $data = [
        'nome' => $nome,
        'email' => $email,
        'sexo' => $sexo,
        'funcao' => $funcao,
        'id_perfil' => $idPerfil,
        'id_unidade' => $idUnidade,
        'atualizado_em' => date('Y-m-d H:i:s')
    ];

    if (!empty($senha)) {
        $data['senha'] = password_hash($senha, PASSWORD_BCRYPT);
    }

    $result = DB::update('usuario', $data, [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('usuario/editar', [
            'id' => $id,
            'success' => 'Edição realizada com sucesso!'
        ]);
    } else {
        redirect('usuario/editar', [
            'id' => $id,
            'error' => 'Houve um erro ao tentar realizar a edição, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('usuario/editar', [
        'id' => $id,
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}