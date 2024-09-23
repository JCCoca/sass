<?php component('alert-message'); ?>

<form action="<?= $action; ?>" method="POST" autocomplete="off">
    <div class="form-row">
        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="nome">
                    Nome<span class="text-danger">*</span>
                </label>
                <input 
                    type="text" 
                    name="nome" 
                    id="nome" 
                    class="form-control" 
                    value="<?= $sala->nome ?? ''; ?>" 
                    required
                >
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="quantidade-maquina">
                    Quantidade de Máquina<span class="text-danger">*</span>
                </label>
                <input 
                    type="number" 
                    name="quantidade_maquina" 
                    id="quantidade-maquina" 
                    class="form-control" 
                    value="<?= $sala->quantidade_maquina ?? ''; ?>" 
                    step="1" 
                    min="0"
                    max="999999"
                    required
                >
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="situcao">
                    Situação<span class="text-danger">*</span>
                </label>
                <select 
                    name="situacao" 
                    id="situcao" 
                    class="form-control" 
                    required
                >
                    <option value="">Selecione um</option>
                    <option value="Ativa" <?= (($sala->situacao ?? null) === 'Ativa') ? 'selected' : ''; ?>>Ativa</option>
                    <option value="Inativa" <?= (($sala->situacao ?? null) === 'Inativa') ? 'selected' : ''; ?>>Inativa</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea 
            name="descricao" 
            id="descricao" 
            class="form-control" 
            rows="6"
        ><?= $sala->descricao ?? ''; ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon">
            <i class="fa-regular fa-floppy-disk"></i> 
        </span>
        <span class="text">Salvar</span>
    </button>

    <a href="<?= route('sala'); ?>" class="btn btn-secondary btn-icon-split">
        <span class="icon">
            <i class="fa-regular fa-arrow-left"></i> 
        </span>
        <span class="text">Voltar</span>
    </a>
</form>
