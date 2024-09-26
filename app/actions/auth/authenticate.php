<?php

$email = input('post', 'email', 'email');
$senha = input('post', 'senha');

if (!empty($email) and !empty($senha)) {
    $queryUsuario = $query = DB::query('SELECT * FROM usuario WHERE email = :email AND excluido_em IS NULL', [
        ':email' => $email
    ]);

    if ($queryUsuario->rowCount() === 1) {
        $usuario = $queryUsuario->fetch();

        if (password_verify($senha, $usuario->senha)) {
            regenerateIdSession();

            setSession('auth', [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'sexo' => $usuario->sexo,
                'funcao' => $usuario->funcao,
                'id_perfil' => intval($usuario->id_perfil),
                'id_unidade' => !empty($usuario->id_unidade) ? intval($usuario->id_unidade) : null
            ]);

            clearInputs();
            
            redirect('');
        }
    }

    redirect('login', ['error' => 'Por favor, verifique suas credenciais!']);
} else {
    redirect('login', ['error' => 'Por favor, informe todas as credenciais!']);
}