<?php layout('admin/header', ['title' => 'Início', 'active' => 'inicio']); ?>

<?php if (isOrientador()): ?>
    <?php 

        $totalAgendamentoAguardandoConfirmacao = DB::query("
            SELECT
                COUNT(*) AS total
            FROM agendamento 
            WHERE 
                agendamento.excluido_em IS NULL
                AND agendamento.situacao = 'Aguardando Confirmação' 
                AND agendamento.id_orientador = :id 
            ", [
            ':id' => getSession()['auth']['id']
        ])->fetch()->total;
            
        $totalAgendamentoAprovados = DB::query("
            SELECT
                COUNT(*) AS total
            FROM agendamento 
            WHERE 
                agendamento.excluido_em IS NULL
                AND agendamento.situacao = 'Aprovado' 
                AND agendamento.id_orientador = :id 
        ", [
            ':id' => getSession()['auth']['id']
        ])->fetch()->total;

        $totalAgendamentoRecursado = DB::query("
            SELECT
                COUNT(*) AS total
            FROM agendamento 
            WHERE 
                agendamento.excluido_em IS NULL
                AND agendamento.situacao = 'Recusado' 
                AND agendamento.id_orientador = :id 
        ", [
            ':id' => getSession()['auth']['id']
        ])->fetch()->total;
        
    ?>
    
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total de Agendamentos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalAgendamentoAguardandoConfirmacao + $totalAgendamentoAprovados + $totalAgendamentoRecursado; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-calendar-lines-pen fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total de Agendamentos Aguardando Confirmação
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalAgendamentoAguardandoConfirmacao; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-calendar-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total de Agendamentos Aprovados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalAgendamentoAprovados; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total de Agendamentos Recursados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalAgendamentoRecursado; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-calendar-xmark fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="card-title text-primary font-weight-bold mb-0">
                Meus Agendamentos Confirmados
            </h5>
        </div>
        <div class="card-body">
            <table id="table-agendamento" class="table table-sm table-striped table-hover small my-3">
                <thead class="thead-light">
                    <tr>
                        <th class="align-middle">Sala</th>
                        <th class="align-middle text-center">Data</th>
                        <th class="align-middle text-center">Entrada</th>
                        <th class="align-middle text-center">Saída</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        $(function(){
            window.tableAgendamento = myDataTable('#table-agendamento', {
                url: `<?= route('agendamento/listar'); ?>`,
                data: {
                    situacao: 'Aprovado',
                    data: date('%Y-%m-%d')
                },
                searching: true,
                lengthChange: false,
                pageLength: 20,
                order: [{
                    name: 'agendamento.data',
                    dir: 'asc'
                }, {
                    name: 'sala.nome',
                    dir: 'asc'
                }],
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
                }]
            });
        });
    </script>
<?php endif ?>

<?php if (isOrientador() or isGestor()): ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="card-title text-primary font-weight-bold mb-0">
                Agendamentos de Salas
            </h5>
        </div>
        <div class="card-body">
            <table id="table-agendamento-sala" class="table table-sm table-striped table-hover small my-3">
                <thead class="thead-light">
                    <tr>
                        <th class="align-middle">Sala</th>
                        <th class="align-middle">Orientador</th>
                        <th class="align-middle text-center">Data</th>
                        <th class="align-middle text-center">Entrada</th>
                        <th class="align-middle text-center">Saída</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        $(function(){
            window.tableAgendamentoSala = myDataTable('#table-agendamento-sala', {
                url: `<?= route('agendamento/listar'); ?>`,
                data: {
                    situacao: 'Aprovado',
                    data: date('%Y-%m-%d'),
                    id_unidade: '<?= getSession()['auth']['id_unidade']; ?>'
                },
                searching: true,
                lengthChange: false,
                pageLength: 20,
                order: [{
                    name: 'agendamento.data',
                    dir: 'asc'
                }, {
                    name: 'sala.nome',
                    dir: 'asc'
                }],
                columns: [{
                    name: 'sala.nome',
                    data: 'nome_sala',
                    class: 'align-middle',
                    width: '10%'
                }, {
                    name: 'orientador.nome',
                    data: 'nome_orientador',
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
                }]
            });
        });
    </script>
<?php endif ?>

<?php layout('admin/footer'); ?>