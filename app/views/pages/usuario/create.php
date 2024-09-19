<?php layout('admin/header', ['title' => 'Cadastrar Usuário', 'active' => 'usuarios']); ?>

<h3 class="mb-3">Cadastrar Usuário</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('usuario/form'); ?>
    </div>
</div>

<?php  layout('admin/footer'); ?>