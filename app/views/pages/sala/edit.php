<?php layout('admin/header', ['title' => 'Editar Sala', 'active' => 'sala']); ?>

<?php

    $id = input('get', 'id', 'integer');

    $querySala = DB::query('SELECT * FROM sala WHERE id = :id AND excluido_em IS NULL', [':id' => $id]);

    if (empty($id) or $querySala->rowCount() == 0) {
        show401();
    }

?>

<h3 class="mb-3">Editar Sala</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('sala/form', [
            'action' => route('sala/editar', ['id' => $id]),
            'sala' => $querySala->fetch()
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>