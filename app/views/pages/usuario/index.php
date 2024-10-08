<?php layout('admin/header', ['title' => 'Usuários', 'active' => 'usuario']); ?>

<div class="row align-items-center mb-3">
    <div class="col-6">
        <h3 class="mb-0">Usuários</h3>
    </div>
    <div class="col-6 text-right">
        <a href="<?= route('usuario/cadastrar'); ?>" class="btn btn-primary btn-icon-split">
            <span class="icon">
                <i class="fa-regular fa-plus"></i> 
            </span>
            <span class="text">Adicionar</span>
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('alert-message'); ?>

        <table id="table-usuario" class="table table-sm table-striped table-hover small my-3">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle">Nome</th>
                    <th class="align-middle">E-mail</th>
                    <th class="align-middle">Sexo</th>
                    <th class="align-middle">Função</th>
                    <th class="align-middle">Perfil</th>
                    <th class="align-middle">Unidade</th>
                    <th class="align-middle text-center">Ações</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php component('modal-confirm-delete', ['message' => 'Você tem certeza que deseja EXCLUIR esta usuário?']); ?>

<script>
    $(function(){
        window.tableUsuario = myDataTable('#table-usuario', {
            url: `<?= route('usuario/listar'); ?>`,
            columns: [{
                name: 'usuario.nome',
                data: 'nome',
                class: 'align-middle',
                width: '15%'
            }, {
                name: 'usuario.email',
                data: 'email',
                class: 'align-middle',
                width: '15%'
            }, {
                name: 'usuario.sexo',
                data: 'sexo',
                class: 'align-middle',
                width: '15%'
            }, {
                name: 'usuario.funcao',
                data: 'funcao',
                class: 'align-middle',
                width: '15%'
            }, {
                name: 'perfil.nome',
                data: 'nome_perfil',
                class: 'align-middle',
                width: '15%'
            }, {
                name: 'unidade.nome',
                data: 'nome_unidade',
                class: 'align-middle',
                width: '15%'
            }, {
                name: null,
                data: null,
                searchable: false,
                orderable: false,
                class: 'align-middle text-center',
                width: '10%',
                render(data){
                    return `
                        <div class="d-inline-flex">
                            <a href="${data.links.edit}" class="btn btn-sm btn-outline-primary  mr-2">
                                <i class="fa-regular fa-pencil"></i>
                            </a>

                            <button 
                                type="button" 
                                class="btn btn-sm btn-outline-danger"
                                onclick="confirmDelete('${data.links.delete}')"    
                            >
                                <i class="fa-regular fa-trash-alt"></i>
                            </button>
                        </div>
                    `;
                }
            }]
        });
    });
</script>

<?php layout('admin/footer'); ?>