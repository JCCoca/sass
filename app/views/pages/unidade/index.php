<?php layout('admin/header', ['title' => 'Unidades', 'active' => 'unidade']); ?>

<div class="row align-items-center mb-3">
    <div class="col-6">
        <h3 class="mb-0">Unidades</h3>
    </div>
    <div class="col-6 text-right">
        <a href="<?= route('unidade/cadastrar'); ?>" class="btn btn-primary btn-icon-split">
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

        <table id="table-unidade" class="table table-sm table-striped table-hover small my-3">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle">Nome</th>
                    <th class="align-middle">Cidade</th>
                    <th class="align-middle">Estado</th>
                    <th class="align-middle text-center">Ações</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php component('modal-confirm-delete', ['message' => 'Você tem certeza que deseja EXCLUIR esta unidade?']); ?>

<script>
    $(function(){
        window.tableUnidade = myDataTable('#table-unidade', {
            url: `<?= route('unidade/listar'); ?>`,
            columns: [{
                name: 'unidade.nome',
                data: 'nome',
                class: 'align-middle',
                width: '35%'
            }, {
                name: 'cidade.nome',
                data: 'nome_cidade',
                class: 'align-middle',
                width: '25%'
            }, {
                name: 'estado.nome',
                data: 'nome_estado',
                class: 'align-middle',
                width: '25%'
            }, {
                name: null,
                data: null,
                searchable: false,
                orderable: false,
                class: 'align-middle text-center',
                width: '15%',
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