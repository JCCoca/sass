<?php layout('admin/header', ['title' => 'Editar Usuário', 'active' => 'usuarios']); ?>

<h3 class="mb-3">Editar Usuário</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('usuario/form'); ?>
    </div>
</div>

<?php  layout('admin/footer'); ?>