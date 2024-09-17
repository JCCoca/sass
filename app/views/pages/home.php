<?php layout('admin/header', ['title' => 'Início', 'active' => 'home']); ?>

<h3 class="mb-3">Seja Bem-Vindo!</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <button type="button" class="btn btn-primary">Primary</button>
        <button type="button" class="btn btn-secondary">Secondary</button>
        <button type="button" class="btn btn-success">Success</button>
        <button type="button" class="btn btn-danger">Danger</button>
        <button type="button" class="btn btn-warning">Warning</button>
        <button type="button" class="btn btn-info">Info</button>
        <button type="button" class="btn btn-light">Light</button>
        <button type="button" class="btn btn-dark">Dark</button>
    </div>
</div>

<?php  layout('admin/footer'); ?>