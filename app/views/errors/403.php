<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php layout('head', ['title' => '403']); ?>
</head>
<body class="bg-primary">
    <div class="container my-4">
        <div class="text-center text-white mb-4">
            <div class="barlow-condensed-semibold" style="font-size: 6rem; line-height: 1;">
                403
            </div>
            <div class="barlow-condensed-semibold" style="font-size: 3rem; line-height: 1;">
                Acesso Proibido!
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <p class="lead">
                    Eita, não dá pra entrar por aqui!
                </p>
                <p class="mb-4">
                    Parece que você tentou acessar uma área que está trancada a sete chaves. Só quem tem a chave mestra pode passar por essa porta... e infelizmente, hoje não é o seu dia de sorte. 😅
                </p>
                <div class="mb-4">
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa-regular fa-check-circle text-success"></i> Verifique se você está no lugar certo.
                        </li>
                        <li>
                            <i class="fa-regular fa-check-circle text-success"></i> Caso tenha certeza, entre em contato com o administrador (vai que ele tem a chave).
                        </li>
                    </ul>
                </div>
                <p class="mb-0">
                    Ainda curioso? <br>
                    Relaxa, a gente entende. Mas dessa vez, talvez seja melhor dar meia-volta. 🔑
                </p>
                <a href="<?= route(''); ?>" class="btn btn-primary mt-4">
                    <i class="fa-regular fa-home"></i> Voltar para a Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>