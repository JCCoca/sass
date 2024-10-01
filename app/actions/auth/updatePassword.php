<?php 

$token = input('get', 'token');

if (empty($token)) {
    $email = input('post', 'email', 'email');
    $token = getRandomToken();

    $usuario = getUsuario($email);

    if ($usuario !== null) {
        $queryRedefinicaoSenha = DB::query('
            SELECT * FROM redefinicao_senha 
            WHERE 
                email = :email 
                AND data_hora_redefinicao IS NULL 
                AND data_hora_solicitacao > :data
        ', [
            ':email' => $email, 
            ':data' => date('Y-m-d H:i:s', strtotime('-1 hour', time()))
        ]);

        if ($queryRedefinicaoSenha->rowCount() === 0) {
            DB::create('redefinicao_senha', [
                'email' => $email,
                'token' => $token,
                'data_hora_solicitacao' => date('Y-m-d H:i:s')
            ]);
    
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
            redirect('redefinir-senha', ['error' => 'Um link de redefinição já foi enviado há menos de uma hora. Por favor, utilize-o ou aguarde uma hora!']);
        }
    } else {
        redirect('redefinir-senha', ['error' => 'O e-mail fornecido não foi encontrado em nossos registros!']);
    }
} else {
    $novaSenha = input('POST', 'nova_senha');
    $confirmarNovaSenha = input('POST', 'confirmar_nova_senha');

    if (!empty($novaSenha) and !empty($confirmarNovaSenha)) {
        $redefinicaoSenha = getRedefinicaoSenha($token);

        if ($redefinicaoSenha !== null) {
            if ($redefinicaoSenha->data_hora_redefinicao !== null) {
                redirect('redefinir-senha', [
                    'error' => 'Este link de redefinição de senha já foi utilizado!'
                ]);
            }
    
            if (time() - strtotime($redefinicaoSenha->data_hora_solicitacao) > 3600) { 
                redirect('redefinir-senha', [
                    'error' => 'Este link já expirou. Solicite um novo para redefinir sua senha!'
                ]);
            }

            if ($novaSenha === $confirmarNovaSenha) {
                $result = DB::update('usuario', [
                    'senha' =>  password_hash($novaSenha, PASSWORD_BCRYPT),
                    'atualizado_em' => date('Y-m-d H:i:s')
                ], [
                    'email' => $redefinicaoSenha->email
                ]);

                if ($result) {
                    DB::update('redefinicao_senha', [
                        'data_hora_redefinicao' => date('Y-m-d H:i:s')
                    ], [
                        'id' => $redefinicaoSenha->id
                    ]);

                    $usuario = getUsuario($redefinicaoSenha->email);

                    sendMail(
                        [
                            [
                                'name' => $usuario->nome,
                                'email' => $usuario->email
                            ]
                        ], 
                        'Confirmação de Alteração de Senha', 
                        mailContent('auth/confirmReset', [
                            'nome' => $usuario->nome
                        ])
                    );

                    redirect('login', [
                        'success' => 'Senha alterada com sucesso'
                    ]);
                } else {
                    redirect('redefinir-senha', [
                        'token' => $token, 
                        'error' => 'Erro ao alterar a senha!'
                    ]);
                }
            } else {
                redirect('redefinir-senha', [
                    'token' => $token, 
                    'error' => 'Confirmação de nova senha não confere!'
                ]);
            }
        } else {
            redirect('redefinir-senha', [
                'error' => 'Link de redefinição de senha inválido!'
            ]);
        }
    } else {
        redirect('redefinir-senha', [
            'token' => $token, 
            'error' => 'Por favor, preencha todos os campos!'
        ]);
    }
}