<?php layout('admin/header', ['title' => 'Editar Usuário', 'active' => 'usuario']); ?>

<?php

    $id = input('get', 'id', 'integer');

    $usuario = getUsuario($id);

    if (empty($id) or $usuario === null) {
        show401();
    }

?>

<h3 class="mb-3">Editar Usuário</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('usuario/form', [
            'action' => route('usuario/editar', ['id' => $id]),
            'usuario' => $usuario,
            'requiredSenha' => false
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>