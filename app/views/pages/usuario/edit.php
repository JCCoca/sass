<?php layout('admin/header', ['title' => 'Editar Usuário', 'active' => 'usuario']); ?>

<?php

    $id = input('get', 'id', 'integer');

    $queryUsuario = DB::query('SELECT * FROM usuario WHERE id = :id AND excluido_em IS NULL', [':id' => $id]);

    if (empty($id) or $queryUsuario->rowCount() == 0) {
        show401();
    }

?>

<h3 class="mb-3">Editar Usuário</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('usuario/form', [
            'action' => route('usuario/editar', ['id' => $id]),
            'usuario' => $queryUsuario->fetch(),
            'requiredSenha' => false
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>