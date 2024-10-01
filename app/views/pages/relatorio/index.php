<?php layout('admin/header', ['title' => 'Relatórios de Agendamentos', 'active' => 'relatorio']); ?>

<?php 

    $salas = DB::query("
        SELECT * FROM sala 
        WHERE 
            excluido_em IS NULL 
            AND situacao = 'Disponível' 
            AND id_unidade = :idUnidade
        ORDER BY 
            nome ASC
    ", [
        ':idUnidade' => getSession()['auth']['id_unidade']
    ])->fetchAll();
    
?>

<h3 class="mb-3">Relatórios de Agendamentos</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="<?= route('relatorio/imprimir'); ?>" method="GET" target="_blank" not-loading>
            <div class="form-row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="id-sala">
                            Sala
                        </label>
                        <select name="id_sala" id="id-sala" class="form-control">
                            <option value="">Todas</option>
                            <?php foreach ($salas as $sala): ?>
                                <option value="<?= $sala->id; ?>">
                                    <?= $sala->nome; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="data-inicio">
                            Data Início
                        </label>
                        <input 
                            type="date" 
                            name="data_inicio" 
                            id="data-inicio" 
                            class="form-control" 
                            value="<?= date('Y-m-01'); ?>" 
                            required
                        >
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="data-termino">
                            Data Término
                        </label>
                        <input 
                            type="date" 
                            name="data_termino" 
                            id="data-termino" 
                            class="form-control" 
                            value="<?= date('Y-m-t'); ?>" 
                            required
                        >
                    </div>
                </div>                
            </div>

            <button type="submit" class="btn btn-primary btn-icon-split">
                <span class="icon">
                    <i class="fa-regular fa-print"></i> 
                </span>
                <span class="text">Imprimir</span>
            </button>
        </form>
    </div>
</div>

<?php layout('admin/footer'); ?>