<?php layout('admin/header', ['title' => 'Editar Unidade', 'active' => 'unidade']); ?>

<?php

    $id = input('get', 'id', 'integer');

    $queryUnidade = DB::query('SELECT * FROM unidade WHERE id = :id AND excluido_em IS NULL', [':id' => $id]);

    if (empty($id) or $queryUnidade->rowCount() == 0) {
        show401();
    }

?>

<h3 class="mb-3">Editar Unidade</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('unidade/form', [
            'action' => route('unidade/editar', ['id' => $id]),
            'unidade' => $queryUnidade->fetch()
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>