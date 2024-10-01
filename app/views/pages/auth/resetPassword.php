<?php layout('auth/header', ['title' => 'Redefinir Senha']); ?>

<?php

    $token = input('get', 'token');

    $queryRedefinicaoSenha = DB::query('SELECT * FROM redefinicao_senha WHERE token = :token', [
        ':token' => $token
    ]);

?>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-md-5 p-4">
                            <div class="d-flex mb-4">
                                <img 
                                    src="<?= asset('images/logo_senac.png'); ?>" 
                                    style="width: 120px; height: auto;" 
                                    class="mx-auto"
                                >
                            </div>

                            <h1 class="h4 text-gray-900 text-center mb-4">
                                Redefinir Senha
                            </h1>

                            <?php component('alert-message'); ?>
                            
                            <?php if (empty($token)): ?>
                                <form action="<?= route('redefinir-senha'); ?>" method="POST" class="user">
                                    <div class="form-group">
                                        <input 
                                            type="email" 
                                            name="email" 
                                            id="email" 
                                            class="form-control form-control-user" 
                                            placeholder="E-mail" 
                                            required
                                        >
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Redefinir senha
                                    </button>

                                    <hr>

                                    <div class="text-center">
                                        <a href="<?= route('login'); ?>" class="small">
                                            Acesso ao sistema
                                        </a>
                                    </div>
                                </form>
                            <?php else: ?>

                            <?php endif ?>

                            <div class="text-center small mt-3">
                                <span>Copyright &copy; Senac/AC <?= date('Y'); ?>. Todos os direitos reservados.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php layout('auth/footer'); ?>