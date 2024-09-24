<?php layout('admin/header', ['title' => 'Editar Disponibilidade', 'active' => 'sala']); ?>

<?php

    $id = input('get', 'id', 'integer');
    $idSala = input('get', 'id_sala', 'integer');

    $queryDisponibilidade = DB::query('SELECT * FROM disponibilidade_sala WHERE id = :id', [':id' => $id]);

    if (empty($id) or $queryDisponibilidade->rowCount() == 0) {
        show401();
    }

?>

<h3 class="mb-3">Editar Disponibilidade</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('disponibilidade-sala/form', [
            'action' => route('sala/disponibilidade/editar', ['id' => $id]),
            'disponibilidade' => $queryDisponibilidade->fetch(),
            'idSala' => $idSala
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>