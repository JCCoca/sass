<?php component('alert-message'); ?>

<?php 

    $diasSemana = DB::query('SELECT * FROM dia_semana')->fetchAll();

?>

<form action="<?= $action; ?>" method="POST" autocomplete="off">
    <div class="form-row">
        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="id-dia-semana">
                    Dia da Semana<span class="text-danger">*</span>
                </label>
                <select name="id_dia_semana" id="id-dia-semana" class="form-control" required>
                    <option value="">Selecione um</option>
                    <?php foreach ($diasSemana as $diaSemana): ?>
                        <option 
                            value="<?= $diaSemana->id; ?>" 
                            <?= ($diaSemana->id === ($disponibilidade->id_dia_semana ?? null)) ? 'selected' : ''; ?>
                        >
                            <?= $diaSemana->nome; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="hora-inicio">
                    Hora de Início<span class="text-danger">*</span>
                </label>
                <input 
                    type="time" 
                    name="hora_inicio" 
                    id="hora-inicio" 
                    class="form-control" 
                    value="<?= $disponibilidade->hora_inicio ?? ''; ?>" 
                    required
                >
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="hora-termino">
                    Hora de Término<span class="text-danger">*</span>
                </label>
                <input 
                    type="time" 
                    name="hora_termino" 
                    id="hora-termino" 
                    class="form-control" 
                    value="<?= $disponibilidade->hora_termino ?? ''; ?>" 
                    required
                >
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon">
            <i class="fa-regular fa-floppy-disk"></i> 
        </span>
        <span class="text">Salvar</span>
    </button>

    <a href="<?= route('sala/detalhar', ['id' => $idSala]); ?>" class="btn btn-secondary btn-icon-split">
        <span class="icon">
            <i class="fa-regular fa-arrow-left"></i> 
        </span>
        <span class="text">Voltar</span>
    </a>
</form>
