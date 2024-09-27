<?php 

    $estados = DB::query('SELECT * FROM estado')->fetchAll();

    if (isset($unidade->id_cidade) and !empty($unidade->id_cidade)) {
        $cidades = DB::query('SELECT * FROM cidade WHERE id_estado = :id ORDER BY nome ASC', [
            ':id' => $unidade->id_estado
        ])->fetchAll();
    }

?>

<?php component('alert-message'); ?>

<form action="<?= $action; ?>" method="POST" autocomplete="off">
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">
                    Nome<span class="text-danger">*</span>
                </label>
                <input 
                    type="text" 
                    name="nome" 
                    id="nome" 
                    class="form-control" 
                    value="<?= $unidade->nome ?? ''; ?>" 
                    required
                >
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id-estado">
                    Estado<span class="text-danger">*</span>
                </label>
                <select name="id_estado" id="id-estado" class="form-control" required>
                    <option value="">Selecione um</option>
                    <?php foreach ($estados as $estado): ?>
                        <option 
                            value="<?= $estado->id; ?>" 
                            <?= ($estado->id === ($unidade->id_estado ?? null)) ? 'selected' : ''; ?>
                        >
                            <?= $estado->nome; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="id-cidade">
                    Cidade<span class="text-danger">*</span>
                </label>
                <select name="id_cidade" id="id-cidade" class="form-control" required>
                    <option value="">Selecione um</option>
                    <?php foreach ($cidades as $cidade): ?>
                        <option 
                            value="<?= $cidade->id; ?>" 
                            class="cidade"
                            <?= ($cidade->id === ($unidade->id_cidade ?? null)) ? 'selected' : ''; ?>
                        >
                            <?= $cidade->nome; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon">
            <i class="fa-regular fa-floppy-disk"></i> 
        </span>
        <span class="text">Salvar</span>
    </button>

    <a href="<?= route('unidade'); ?>" class="btn btn-secondary btn-icon-split">
        <span class="icon">
            <i class="fa-regular fa-arrow-left"></i> 
        </span>
        <span class="text">Voltar</span>
    </a>
</form>

<script>
    $(function(){
        $('#id-estado').change(function(){
            let idEstado = $(this).val();

            $('#id-cidade > option.cidade').remove();

            if (!empty(idEstado)) {
                $.ajax({
                    url: '<?= route('cidade/obter'); ?>',
                    method: 'GET',
                    data: {
                        id_estado: idEstado
                    }
                }).then((response) => {
                    $.each(response.data, (index, data) => {
                        $('#id-cidade').append(`<option value="${data.id}" class="cidade">${data.nome}</option>`);
                    });
                });
            }
        });
    });
</script>