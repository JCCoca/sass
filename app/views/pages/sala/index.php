<?php layout('admin/header', ['title' => 'Salas', 'active' => 'sala']); ?>

<div class="row align-items-center mb-3">
    <div class="col-6">
        <h3 class="mb-0">Salas</h3>
    </div>
    <div class="col-6 text-right">
        <a href="<?= route('sala/cadastrar'); ?>" class="btn btn-primary btn-icon-split">
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

        <table id="table-sala" class="table table-sm table-striped table-hover small my-3">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle">Nome</th>
                    <th class="align-middle text-center">Quantidade Máquina</th>
                    <th class="align-middle">Descrição</th>
                    <th class="align-middle">Unidade</th>
                    <th class="align-middle text-center">Situação</th>
                    <th class="align-middle text-center">Ações</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php component('modal-confirm-delete', ['message' => 'Você tem certeza que deseja EXCLUIR esta sala?']); ?>

<script>
    $(function(){
        window.tableSala = myDataTable('#table-sala', {
            url: `<?= route('sala/listar'); ?>`,
            columns: [{
                name: 'sala.nome',
                data: null,
                class: 'align-middle',
                width: '20%',
                render(data){
                    return `<a href="${data.links.detail}">${data.nome}</a>`;
                }
            }, {
                name: 'sala.quantidade_maquina',
                data: 'quantidade_maquina',
                class: 'align-middle text-center',
                width: '15%'
            }, {
                name: 'sala.descricao',
                data: null,
                class: 'align-middle',
                width: '20%',
                render(data){
                    return data.descricao ?? '-';
                }
            }, {
                name: 'unidade.nome',
                data: 'nome_unidade',
                class: 'align-middle',
                width: '20%'
            }, {
                name: 'sala.situacao',
                data: null,
                class: 'align-middle text-center',
                width: '10%',
                render(data){
                    return `
                        <span class="badge badge-pill ${data.situacao === 'Disponível' ? 'badge-success' : 'badge-danger'}">
                            ${data.situacao}
                        </span>
                    `;
                }
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