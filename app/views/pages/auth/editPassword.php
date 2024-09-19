<?php layout('admin/header', ['title' => 'Alterar Senha']); ?>

<h3 class="mb-3">Alterar Senha</h3>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="senha-atual">Senha Atual</label>
                        <input 
                            type="password" 
                            name="senha_atual" 
                            id="senha-atual" 
                            class="form-control" 
                            minlength="6"
                            required
                        >
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nova-senha">Nova Senha</label>
                        <input 
                            type="password" 
                            name="nova_senha" 
                            id="nova-senha" 
                            class="form-control" 
                            minlength="6"
                            required
                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirmar-nova-senha">Confirmar Nova Senha</label>
                        <input 
                            type="password" 
                            name="confirmar_nova_senha" 
                            id="confirmar-nova-senha" 
                            class="form-control" 
                            minlength="6"
                            required
                        >
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-pencil"></i> Alterar Senha
            </button>
        </form>
    </div>
</div>

<?php  layout('admin/footer'); ?>