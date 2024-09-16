<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php layout('head', ['title' => '404']); ?>
</head>
<body class="bg-primary">
    <div class="container my-4">
        <div class="text-center text-white mb-4">
            <div class="barlow-condensed-semibold" style="font-size: 6rem; line-height: 1;">
                404
            </div>
            <div class="barlow-condensed-semibold" style="font-size: 3rem; line-height: 1;">
                Página Não Encontrada!
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <p class="lead">Ih, deu ruim!</p>
                <p class="mb-4">
                    Parece que você acabou de tropeçar em uma página que não existe mais (ou nunca existiu). <br>
                    Quem sabe ela foi tomar um café e nunca voltou... 😅
                </p>
                <div class="mb-4">
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa-regular fa-check-circle text-success"></i> Verifique se você digitou o endereço corretamente.
                        </li>
                        <li>
                            <i class="fa-regular fa-check-circle text-success"></i> Use a barra de pesquisa para tentar encontrar o que está procurando.
                        </li>
                        <li>
                            <i class="fa-regular fa-check-circle text-success"></i> Ou simplesmente clique no botão abaixo e volte para a página inicial.
                        </li>
                    </ul>
                </div>
                <p class="mb-0">
                    Ainda perdido? <br>
                    Relaxa, até os melhores exploradores se perdem de vez em quando. 🌍
                </p>
                <a href="<?= route(''); ?>" class="btn btn-primary mt-4">
                    <i class="fa-regular fa-home"></i> Voltar para a Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>