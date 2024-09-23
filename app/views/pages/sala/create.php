<?php layout('admin/header', ['title' => 'Cadastrar Sala', 'active' => 'sala']); ?>

<h3 class="mb-3">Cadastrar Sala</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('sala/form', [
            'action' => route('sala/cadastrar')
        ]); ?>
    </div>
</div>

<?php layout('admin/footer'); ?>