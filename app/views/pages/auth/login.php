<?php layout('site/header', ['title' => 'Login']); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <h2 class="text-center mb-4">
                Login
            </h2>

            <?php component('alert-message'); ?>

            <form action="<?= route('authenticate'); ?>" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
                    <label for="email">E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
                    <label for="senha">Senha</label>
                </div>
                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa-regular fa-arrow-right-to-bracket"></i> Acessar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php layout('site/footer'); ?>