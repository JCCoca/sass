<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php layout('head', ['title' => '401']); ?>
</head>
<body class="bg-primary">
    <div class="container my-4">
        <div class="text-center text-white mb-4">
            <div class="barlow-condensed-semibold" style="font-size: 6rem; line-height: 1;">
                401
            </div>
            <div class="barlow-condensed-semibold" style="font-size: 3rem; line-height: 1;">
                Acesso Negado!
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <p class="lead">
                    Ops! Parece que você não tem permissão para acessar essa página.
                </p>
                <p class="mb-4">
                    Talvez você tenha esquecido de fazer login, ou então nosso sistema está com ciúmes do seu talento e não quer deixar você entrar... 😅
                </p>
                <div class="mb-4">
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa-regular fa-check-circle text-success"></i> Verifique se você está logado.
                        </li>
                        <li>
                            <i class="fa-regular fa-check-circle text-success"></i> Confirme se você tem as permissões necessárias.
                        </li>
                        <li>
                            <i class="fa-regular fa-check-circle text-success"></i> Se tudo isso estiver certo, tente dar um F5 (quem sabe?).
                        </li>
                    </ul>
                </div>
                <p class="mb-0">
                    Ainda não deu certo? <br>Relaxa! Nossa equipe está pronta para ajudar. 💪
                </p>
                <a href="<?= route(''); ?>" class="btn btn-primary mt-4">
                    <i class="fa-regular fa-home"></i> Voltar para a Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>