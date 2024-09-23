<?php 

    $perfis = DB::query('SELECT * FROM perfil WHERE excluido_em IS NULL')->fetchAll();
    $unidades = DB::query('SELECT * FROM unidade WHERE excluido_em IS NULL')->fetchAll();

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
                    value="<?= $usuario->nome ?? ''; ?>" 
                    required
                >
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="email">
                    E-mail<span class="text-danger">*</span>
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control" 
                    value="<?= $usuario->email ?? ''; ?>" 
                    required
                >
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="senha">
                    Senha<span class="text-danger <?= !$requiredSenha ? 'd-none' : ''; ?>">*</span>
                </label>
                <input 
                    type="password" 
                    name="senha" 
                    id="senha" 
                    class="form-control" 
                    <?= $requiredSenha ? 'required' : ''; ?>
                >
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="sexo">
                    Sexo<span class="text-danger">*</span>
                </label>
                <select name="sexo" id="sexo" class="form-control" required>
                    <option value="">Selecione um</option>
                    <option value="Masculino" <?= (($usuario->sexo ?? null) === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="Feminino" <?= (($usuario->sexo ?? null) === 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="funcao">
                    Função<span class="text-danger">*</span>
                </label>
                <input 
                    type="text" 
                    name="funcao" 
                    id="funcao" 
                    class="form-control" 
                    value="<?= $usuario->funcao ?? ''; ?>" 
                    required
                >
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="id-perfil">
                    Perfil<span class="text-danger">*</span>
                </label>
                <select name="id_perfil" id="id-perfil" class="form-control" required>
                    <option value="">Selecione um</option>
                    <?php foreach ($perfis as $perfil): ?>
                        <option 
                            value="<?= $perfil->id; ?>" 
                            <?= ($perfil->id === ($usuario->id_perfil ?? null)) ? 'selected' : ''; ?>
                        >
                            <?= $perfil->nome; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <label for="id-unidade">
                    Unidade<span class="text-danger">*</span>
                </label>
                <select name="id_unidade" id="id-unidade" class="form-control" required>
                    <option value="">Selecione um</option>
                    <?php foreach ($unidades as $unidade): ?>
                        <option 
                            value="<?= $unidade->id; ?>" 
                            <?= ($unidade->id === ($usuario->id_unidade ?? null)) ? 'selected' : ''; ?>
                        >
                            <?= $unidade->nome; ?>
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

    <a href="<?= route('usuario'); ?>" class="btn btn-secondary btn-icon-split">
        <span class="icon">
            <i class="fa-regular fa-arrow-left"></i> 
        </span>
        <span class="text">Voltar</span>
    </a>
</form>