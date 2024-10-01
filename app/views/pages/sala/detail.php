<?php layout('admin/header', ['title' => 'Detalhar Sala', 'active' => 'sala']); ?>

<?php

    $id = input('get', 'id', 'integer');

    $querySala = DB::query('SELECT * FROM sala WHERE id = :id AND excluido_em IS NULL', [':id' => $id]);

    if (empty($id) or $querySala->rowCount() == 0) {
        show401();
    }

    $sala = $querySala->fetch();

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col-6">
                <h4 class="card-title text-primary font-weight-bold mb-0">
                    Sala
                </h4>
            </div>
            <div class="col-6 text-right">
                <?php if (isGestor()): ?>
                    <a href="<?= route('sala/editar', ['id' => $sala->id, 'back' => 'detail']); ?>" class="btn btn-primary btn-icon-split">
                        <span class="icon">
                            <i class="fa-regular fa-pencil"></i> 
                        </span>
                        <span class="text">Editar</span>
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <tr class="thead-light">
                <th class="align-middle" colspan="2">Nome</th>
            </tr>
            <tr>
                <td class="align-middle" colspan="2"><?= $sala->nome; ?></td>
            </tr>
            <tr class="thead-light">
                <th class="align-middle">Quantidade de Máquina</th>
                <th class="align-middle">Situação</th>
            </tr>
            <tr>
                <td class="align-middle"><?= $sala->quantidade_maquina; ?></td>
                <td class="align-middle">
                    <span class="badge badge-pill <?= $sala->situacao === 'Disponível' ? 'badge-success' : 'badge-danger'; ?>">
                        <?= $sala->situacao; ?>
                    </span>
                </td>
            </tr>
            <tr class="thead-light">
                <th class="align-middle" colspan="2">Descrição</th>
            </tr>
            <tr>
                <td class="align-middle" colspan="2"><?= $sala->descricao ?? '-'; ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col-6">
                <h4 class="card-title text-primary font-weight-bold mb-0">
                    Disponibilidade
                </h4>
            </div>

            <div class="col-6 text-right">
                <?php if (isGestor()): ?>
                    <a href="<?= route('sala/disponibilidade/cadastrar', ['id_sala' => $id]); ?>" class="btn btn-primary btn-icon-split">
                        <span class="icon">
                            <i class="fa-regular fa-plus"></i> 
                        </span>
                        <span class="text">Adicionar</span>
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php component('alert-message'); ?>

        <table id="table-disponibilidade-sala" class="table table-sm table-striped table-hover small my-3">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle">Dia da Semana</th>
                    <th class="align-middle text-center">Hora Início</th>
                    <th class="align-middle text-center">Hora Término</th>
                    <?php if (isGestor()): ?>
                        <th class="align-middle text-center">Ações</th>
                    <?php endif ?>
                </tr>
            </thead>
        </table>
    </div>
</div>

<a href="<?= route('sala'); ?>" class="btn btn-secondary btn-icon-split mb-4">
    <span class="icon">
        <i class="fa-regular fa-arrow-left"></i> 
    </span>
    <span class="text">Voltar</span>
</a>

<?php component('modal-confirm-delete', ['message' => 'Você tem certeza que deseja EXCLUIR esta disponibilidade?']); ?>

<script>
    $(function(){
        var columns = [{
            name: 'dia_semana.nome',
            data: 'nome_dia_semana',
            class: 'align-middle',
            width: '40%',
        }, {
            name: 'disponibilidade_sala.hora_inicio',
            data: 'hora_inicio',
            class: 'align-middle text-center',
            width: '20%'
        }, {
            name: 'disponibilidade_sala.hora_termino',
            data: 'hora_termino',
            class: 'align-middle text-center',
            width: '20%'
        }];

        <?php if (isGestor()): ?>
            columns.push({
                name: null,
                data: null,
                searchable: false,
                orderable: false,
                class: 'align-middle text-center',
                width: '20%',
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
            });
        <?php endif ?>
        
        window.tableDiponibilidadeSala = myDataTable('#table-disponibilidade-sala', {
            url: `<?= route('sala/disponibilidade/listar'); ?>`,
            ordering: false,
            data: {
                id_sala: '<?= $id; ?>'
            },
            columns: columns
        });
    });
</script>

<?php layout('admin/footer'); ?>