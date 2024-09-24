<?php layout('admin/header', ['title' => 'Cadastrar Disponibilidade', 'active' => 'sala']); ?>

<?php

    $idSala = input('get', 'id_sala', 'integer');

?>

<h3 class="mb-3">Cadastrar Disponibilidade</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('disponibilidade-sala/form', [
            'action' => route('sala/disponibilidade/cadastrar'),
            'idSala' => $idSala
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>