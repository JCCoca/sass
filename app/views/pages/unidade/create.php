<?php layout('admin/header', ['title' => 'Cadastrar Unidade', 'active' => 'unidade']); ?>

<h3 class="mb-3">Cadastrar Unidade</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('unidade/form', [
            'action' => route('unidade/cadastrar')
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>