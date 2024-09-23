<?php layout('admin/header', ['title' => 'Detalhar Sala', 'active' => 'sala']); ?>

<?php

    $id = input('get', 'id', 'integer');

    $querySala = DB::query('SELECT * FROM sala WHERE id = :id AND excluido_em IS NULL', [':id' => $id]);

    if (empty($id) or $querySala->rowCount() == 0) {
        show401();
    }

    $sala = $querySala->fetch();

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="card-title text-primary font-weight-bold mb-0">Sala</h4>
    </div>
    <div class="card-body">
        
    </div>
</div>

<a href="<?= route('sala'); ?>" class="btn btn-secondary btn-icon-split">
    <span class="icon">
        <i class="fa-regular fa-arrow-left"></i> 
    </span>
    <span class="text">Voltar</span>
</a>

<?php layout('admin/footer'); ?>