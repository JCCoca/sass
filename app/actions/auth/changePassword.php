<?php

$senhaAtual = input('post', 'senha_atual');
$novaSenha = input('post', 'nova_senha');
$confirmarNovaSenha = input('post', 'confirmar_nova_senha');

if (
    !empty($senhaAtual) 
    and !empty($novaSenha) 
    and !empty($confirmarNovaSenha)
) {
    $auth = getUsuario(getSession()['auth']['id']);

    if (password_verify($senhaAtual, $auth->senha)) {
        if ($novaSenha === $confirmarNovaSenha) {
            $result = DB::update('usuario', [
                'senha' =>  password_hash($novaSenha, PASSWORD_BCRYPT),
                'atualizado_em' => date('Y-m-d H:i:s')
            ], [
                'id' => $auth->id
            ]);

            if ($result) {
                redirect('alterar-senha', ['success' => 'Senha alterada com sucesso']);
            } else {
                redirect('alterar-senha', ['error' => 'Erro ao alterar a senha!']);
            }
        } else {
            redirect('alterar-senha', ['error' => 'Confirmação de nova senha não confere!']);
        }
    } else {
        redirect('alterar-senha', ['error' => 'Senha atual incorreta. Tente novamente!']);
    }
} else {
    redirect('alterar-senha', ['error' => 'Por favor, preencha todos os campos!']);
}