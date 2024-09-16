<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php layout('head', ['title' => '500']); ?>
</head>
<body class="bg-primary">
    <div class="container my-4">
        <div class="text-center text-white mb-4">
            <div class="barlow-condensed-semibold" style="font-size: 6rem; line-height: 1;">
                500
            </div>
            <div class="barlow-condensed-semibold" style="font-size: 3rem; line-height: 1;">
                Erro Interno no Servidor!
            </div>
        </div>

        <?php if (APP_DEBUG === false or empty($error)): ?>
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <p class="lead">
                        Opa, algo deu muito errado por aqui!
                    </p>
                    <p class="mb-4">
                        Parece que o servidor tomou um tombo daqueles e não conseguiu processar sua solicitação. Talvez seja hora de dar um café para ele... ☕😅
                    </p>
                    <div class="mb-4">
                        <ul class="list-unstyled">
                            <li>
                                <i class="fa-regular fa-sync-alt"></i> Tente recarregar a página.
                            </li>
                            <li>
                                <i class="fa-regular fa-clock"></i> Volte mais tarde, pode ser que o servidor já esteja de pé de novo.
                            </li>
                            <li>
                                <i class="fa-regular fa-headset"></i> Se o problema persistir, entre em contato com o suporte (eles são os melhores para resolver esses pepinos).
                            </li>
                        </ul>
                    </div>
                    <p class="mb-0">
                        Enquanto isso... <br>
                        Relaxa, não é culpa sua. Essas coisas acontecem até nas melhores famílias de servidores! 🤖
                    </p>
                    <a href="<?= route(''); ?>" class="btn btn-primary mt-4">
                        <i class="fa-regular fa-home"></i> Voltar para a Home
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="text-start">
                        <h5>Detalhes do Erro</h5>
                        <ul>
                            <li>
                                <strong>Mensagem:</strong> <?= htmlspecialchars($error->getMessage()); ?>
                            </li>
                            <li>
                                <strong>Arquivo:</strong> <?= htmlspecialchars($error->getFile()); ?>
                            </li>
                            <li>
                                <strong>Linha:</strong> <?= htmlspecialchars($error->getLine()); ?>
                            </li>
                        </ul>

                        <h5>Rastreamento do Erro:</h5>
                        <pre>
                            <?= htmlspecialchars($error->getTraceAsString()); ?>
                        </pre>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</body>
</html>