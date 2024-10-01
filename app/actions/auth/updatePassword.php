<?php 

$token = input('get', 'token');

if (empty($token)) {
    $email = input('post', 'email', 'email');
    $token = getRandomToken();

    $queryUsuario = DB::query('SELECT * FROM usuario WHERE email = :email AND excluido_em IS NULL', [
        ':email' => $email
    ]);

    if ($queryUsuario->rowCount() === 1) {
        DB::create('redefinicao_senha', [
            'email' => $email,
            'token' => $token,
            'data_hora_solicitacao' => date('Y-m-d H:i:s')
        ]);

        $usuario = $queryUsuario->fetch();
        $link = route('redefinir-senha', ['token' => $token]);

        sendMail(
            [
                [
                    'name' => $usuario->nome,
                    'email' => $usuario->email
                ]
            ], 
            'Redefinição de Senha', 
            mailContent('auth/reset', [
                'nome' => $usuario->nome,
                'link' => $link
            ])
        );
        
        redirect('redefinir-senha', ['success' => 'E-mail de redefinição senha enviado com sucesso!']);
    } else {
        redirect('redefinir-senha', ['error' => 'O e-mail fornecido não foi encontrado em nossos registros!']);
    }
} else {

}