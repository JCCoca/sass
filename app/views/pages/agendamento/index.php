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

<?php component('modal', ['id' => 'modal-detalhamento', 'title' => 'Detalhamento do Agendamento']); ?>

<script>
    $(function(){
        var columns = [];
        
        <?php if (isGestor()): ?>
            columns.push({
                name: 'orientador.nome',
                data: 'nome_orientador',
                class: 'align-middle',
                width: '20%'
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
            name: 'agendamento.situacao',
            data: null,
            class: 'align-middle text-center',
            width: '10%',
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
                                    class="btn btn-sm btn-outline-primary btn-detalhamento"
                                    data-id="${data.id}"
                                >
                                    <i class="fa-regular fa-magnifying-glass-plus"></i>
                                </button>

                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-success mx-2"
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
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-primary btn-detalhamento"
                                    data-id="${data.id}"
                                >
                                    <i class="fa-regular fa-magnifying-glass-plus"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-success mx-2" disabled>
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
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-primary btn-detalhamento"
                                    data-id="${data.id}"
                                >
                                    <i class="fa-regular fa-magnifying-glass-plus"></i>
                                </button>

                                <a href="${data.links.edit}" class="btn btn-sm btn-outline-primary mx-2">
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
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-primary btn-detalhamento"
                                    data-id="${data.id}"
                                >
                                    <i class="fa-regular fa-magnifying-glass-plus"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-primary mx-2" disabled>
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

        $(document).on('click', 'button.btn-detalhamento', (event) => {
            event.preventDefault();

            let button = $(event.currentTarget);
            let id = button.data('id');

            $.ajax({
                url: '<?= route('agendamento/obter'); ?>',
                method: 'GET',
                data: {
                    id: id
                }
            }).then((response) => {
                let agendamento = response.data;

                $('#modal-detalhamento-body').html(`
                    <table class="table table-sm">
                        <tr class="thead-light">
                            <th class="align-middle" style="width: calc(100% / 3);">Orientador</th>
                            <th class="align-middle" style="width: calc(100% / 3);">Data da Solicitação</th>
                            <th class="align-middle" style="width: calc(100% / 3);">Sala</th>
                        </tr>
                        <tr>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                        </tr>
                        <tr class="thead-light">
                            <th class="align-middle" style="width: calc(100% / 3);">Data</th>
                            <th class="align-middle" style="width: calc(100% / 3);">Hara Início</th>
                            <th class="align-middle" style="width: calc(100% / 3);">Hara Término</th>
                        </tr>
                        <tr>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                        </tr>
                        <tr class="thead-light">
                            <th class="align-middle" style="width: calc(100% / 3);">Turma</th>
                            <th class="align-middle" style="width: calc(100% / 3);">Curso</th>
                            <th class="align-middle" style="width: calc(100% / 3);">UC</th>
                        </tr>
                        <tr>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                        </tr>
                        <tr class="thead-light">
                            <th class="align-middle" colspan="3">Situação</th>
                        </tr>
                        <tr>
                            <td class="align-middle" colspan="3"></td>
                        </tr>
                        <tr class="thead-light">
                            <th class="align-middle" colspan="3">Justificativa</th>
                        </tr>
                        <tr>
                            <td class="align-middle" colspan="3"></td>
                        </tr>
                        <tr class="thead-light">
                            <th class="align-middle" colspan="2">Gestor</th>
                            <th class="align-middle">Data Avalição</th>
                        </tr>
                        <tr>
                            <td class="align-middle" colspan="2"></td>
                            <td class="align-middle"></td>
                        </tr>
                        <tr class="thead-light">
                            <th class="align-middle" colspan="3">Justificativa da Recusa</th>
                        </tr>
                        <tr>
                            <td class="align-middle" colspan="3"></td>
                        </tr>
                    </table>
                `);

                $('#modal-detalhamento').modal('show');
            });
        });
    });
</script>

<?php layout('admin/footer'); ?>