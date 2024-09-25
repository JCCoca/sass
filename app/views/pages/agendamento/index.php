<?php layout('admin/header', ['title' => 'Agendamentos', 'active' => 'agendamento']); ?>

<div class="row align-items-center mb-3">
    <div class="col-6">
        <h3 class="mb-0">Agendamentos</h3>
    </div>
    <div class="col-6 text-right">
        <a href="<?= route('agendamento/cadastrar'); ?>" class="btn btn-primary btn-icon-split">
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

        <table id="table-agendamento" class="table table-sm table-striped table-hover small my-3">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle">Sala</th>
                    <th class="align-middle text-center">Data</th>
                    <th class="align-middle text-center">Entrada</th>
                    <th class="align-middle text-center">Saída</th>
                    <th class="align-middle">Turma</th>
                    <th class="align-middle">UC</th>
                    <th class="align-middle">Motivo</th>
                    <th class="align-middle text-center">Situação</th>
                    <th class="align-middle text-center">Ações</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php component('modal-delete', ['message' => 'Você tem certeza que deseja excluir este agendamento?']); ?>

<script>
    $(function(){
        window.tableAgendamento = myDataTable('#table-agendamento', {
            url: `<?= route('agendamento/listar'); ?>`,
            columns: [{
                name: 'sala.nome',
                data: 'nome_sala',
                class: 'align-middle',
                width: '10%'
            }, {
                name: 'agendamento.data',
                data: 'data',
                class: 'align-middle text-center',
                width: '10%'
            }, {
                name: 'agendamento.hora_inicio',
                data: 'hora_inicio',
                class: 'align-middle text-center',
                width: '10%'
            }, {
                name: 'agendamento.hora_termino',
                data: 'hora_termino',
                class: 'align-middle text-center',
                width: '10%'
            }, {
                name: 'agendamento.turma',
                data: 'turma',
                class: 'align-middle',
                width: '10%'
            }, {
                name: 'agendamento.uc',
                data: 'uc',
                class: 'align-middle',
                width: '10%'
            }, {
                name: 'agendamento.motivo',
                data: 'motivo',
                class: 'align-middle',
                width: '10%'
            }, {
                name: 'agendamento.situacao',
                data: 'situacao',
                class: 'align-middle text-center',
                width: '10%'
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