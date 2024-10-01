<?php layout('auth/header', ['title' => 'Login']); ?>

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
                                Acesso ao Sistema
                            </h1>

                            <?php component('alert-message'); ?>

                            <form action="<?= route('authenticate'); ?>" method="POST" class="user">
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

                                <div class="form-group">
                                    <input 
                                        type="password" 
                                        name="senha" 
                                        id="senha" 
                                        class="form-control form-control-user" 
                                        placeholder="Senha" 
                                        required
                                    >
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Acessar
                                </button>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a href="<?= route('redefinir-senha'); ?>" class="small">
                                    Esqueceu sua senha?
                                </a>
                            </div>

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