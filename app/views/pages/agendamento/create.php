<?php layout('admin/header', ['title' => 'Cadastrar Agendamento', 'active' => 'agendamento']); ?>

<h3 class="mb-3">Cadastrar Agendamento</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('agendamento/form', [
            'action' => route('agendamento/cadastrar')
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>