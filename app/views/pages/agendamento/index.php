<?php layout('admin/header', ['title' => 'Agendamentos', 'active' => 'agendamento']); ?>

<div class="row align-items-center mb-3">
    <div class="col-6">
        <h3 class="mb-0">Agendamentos</h3>
    </div>
    <div class="col-6 text-right">
        <?php if (isOrientador()): ?>
            <a href="<?= route('agendamento/cadastrar'); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon">
                    <i class="fa-regular fa-calendar-lines-pen"></i>
                </span>
                <span class="text">Agendar Sala</span>
            </a>
        <?php endif ?>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php component('alert-message'); ?>

        <table id="table-agendamento" class="table table-sm table-striped table-hover small my-3">
            <thead class="thead-light">
                <tr>
                    <?php if (isGestor()): ?>
                        <th class="align-middle">Orientador</th>
                    <?php endif ?>
                    <th class="align-middle">Sala</th>
                    <th class="align-middle text-center">Data</th>
                    <th class="align-middle text-center">Entrada</th>
                    <th class="align-middle text-center">Saída</th>
                    <th class="align-middle">Turma</th>
                    <th class="align-middle">Curso</th>
                    <th class="align-middle">UC</th>
                    <th class="align-middle">Justificativa</th>
                    <th class="align-middle text-center">Situação</th>
                    <th class="align-middle text-center">Ações</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php if (isGestor()): ?>
    <?php component('modal-confirm-question'); ?>
    <?php component('modal-confirm-justification'); ?>
<?php else: ?>
    <?php component('modal-confirm-delete', ['message' => 'Você tem certeza que deseja EXCLUIR este agendamento?']); ?>
<?php endif ?>

<script>
    $(function(){
        var columns = [];
        
        <?php if (isGestor()): ?>
            columns.push({
                name: 'orientador.nome',
                data: 'nome_orientador',
                class: 'align-middle',
                width: '10%'
            });
        <?php endif ?>

        columns.push({
            name: 'sala.nome',
            data: 'nome_sala',
            class: 'align-middle',
            width: '10%'
        }, {
            name: 'agendamento.data',
            data: 'data',
            class: 'align-middle text-center',
            width: '8%'
        }, {
            name: 'agendamento.hora_inicio',
            data: 'hora_inicio',
            class: 'align-middle text-center',
            width: '8%'
        }, {
            name: 'agendamento.hora_termino',
            data: 'hora_termino',
            class: 'align-middle text-center',
            width: '8%'
        }, {
            name: 'agendamento.turma',
            data: 'turma',
            class: 'align-middle',
            width: '5%'
        }, {
            name: 'agendamento.curso',
            data: 'curso',
            class: 'align-middle',
            width: '10%'
        }, {
            name: 'agendamento.uc',
            data: 'uc',
            class: 'align-middle',
            width: '5%'
        }, {
            name: 'agendamento.justificativa',
            data: 'justificativa',
            class: 'align-middle',
            width: '20%'
        }, {
            name: 'agendamento.situacao',
            data: null,
            class: 'align-middle text-center',
            width: '15%',
            render(data){ 
                let color;
                switch (data.situacao) {
                    case 'Aguardando Confirmação':
                        color = 'warning';
                        break;
                    case 'Aprovado':
                        color = 'success';
                        break;
                    case 'Recusado':
                        color = 'danger';
                        break;
                }

                return `
                    <span class="badge badge-pill badge-${color}">
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
            width: '10%',
            render(data){
                <?php if (isGestor()): ?>
                    if (data.situacao === 'Aguardando Confirmação') {
                        return `
                            <div class="d-inline-flex">
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-success mr-2"
                                    onclick="confirmQuestion('${data.links.confirm}', 'Você tem certeza que deseja APROVAR este agendamento?')"    
                                >
                                    <i class="fa-regular fa-check"></i>
                                </button>

                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="confirmJustification('${data.links.reject}', 'Você tem certeza que deseja RECUSAR este agendamento?')"    
                                >
                                    <i class="fa-regular fa-ban"></i>
                                </button>
                            </div>
                        `;
                    } else {
                        return `
                            <div class="d-inline-flex">
                                <button type="button" class="btn btn-sm btn-outline-success mr-2" disabled>
                                    <i class="fa-regular fa-check"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-danger" disabled>
                                    <i class="fa-regular fa-ban"></i>
                                </button>
                            </div>
                        `;
                    }
                <?php else: ?>
                    if (data.situacao === 'Aguardando Confirmação') {
                        return `
                            <div class="d-inline-flex">
                                <a href="${data.links.edit}" class="btn btn-sm btn-outline-primary mr-2">
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
                    } else {
                        return `
                            <div class="d-inline-flex">
                                <button type="button" class="btn btn-sm btn-outline-primary mr-2" disabled>
                                    <i class="fa-regular fa-pencil"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-danger" disabled>
                                    <i class="fa-regular fa-trash-alt"></i>
                                </button>
                            </div>
                        `;
                    }
                <?php endif ?>
            }
        });

        window.tableAgendamento = myDataTable('#table-agendamento', {
            url: `<?= route('agendamento/listar'); ?>`,
            columns: columns
        });
    });
</script>

<?php layout('admin/footer'); ?>