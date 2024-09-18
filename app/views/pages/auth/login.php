<?php layout('auth/header', ['title' => 'Login']); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <h2 class="text-center mb-4">
                Login
            </h2>

            <?php component('alert-message'); ?>

            <form action="<?= route('authenticate'); ?>" method="POST">
                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa-regular fa-arrow-right-to-bracket"></i> Acessar
                </button>
            </form>
        </div>
    </div>
</div>

<?php layout('auth/footer'); ?>