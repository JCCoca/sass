<?php 

    $input = getInputs()['POST'];
    clearInputs();

    $salas = DB::query("
        SELECT * FROM sala 
        WHERE 
            excluido_em IS NULL 
            AND situacao = 'Disponível' 
            AND id_unidade = :idUnidade
        ORDER BY 
            nome ASC
    ", [
        ':idUnidade' => getSession()['auth']['id_unidade']
    ])->fetchAll();
    
?>

<?php component('alert-message'); ?>

<div id="info-sala" style="display: none;">
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <h5 class="card-title text-primary font-weight-bold mb-0">
                Informações Sobre Sala
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <tr class="bg-primary text-white">
                        <th class="align-middle py-3" colspan="2">
                            <h5 class="mb-0">Dados da Sala</h5>
                        </th>
                    </tr>
                    <tr class="thead-light">
                        <th class="align-middle w-50">Nome</th>
                        <th class="align-middle w-50">Quantidade de Máquina</th>
                    </tr>
                    <tr>
                        <td id="nome-sala" class="align-middle"></td>
                        <td id="quantidade-maquina-sala" class="align-middle"></td>
                    </tr>
                    <tr class="thead-light">
                        <th class="align-middle" colspan="2">Descrição</th>
                    </tr>
                    <tr>
                        <td id="descricao-sala" class="align-middle" colspan="2"></td>
                    </tr>
                </table>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="align-middle py-3" colspan="3">
                                <h5 class="mb-0">Disponibilidade da Sala</h5>
                            </th>
                        </tr>
                        <tr class="thead-light">
                            <th class="align-middle" style="width: calc(100% / 3);">Dia da Semana</th>
                            <th class="align-middle text-center" style="width: calc(100% / 3);">Hora Início</th>
                            <th class="align-middle text-center" style="width: calc(100% / 3);">Hora Término</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-disponibilidade"></tbody>
                </table>
            </div>

            <div class="text-danger">
                * As informações sobre a disponibilidade da sala não refletem os horários já agendados pelos orientadores, mas sim as suas disponibilidades gerais durante os dias da semana. 
                O sistema informará se a data e horário desejados estão disponíveis após a solicitação ser feita.
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="<?= $action; ?>" method="POST" autocomplete="off">
            <div class="form-row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="id-sala">
                            Sala<span class="text-danger">*</span>
                        </label>
                        <select name="id_sala" id="id-sala" class="form-control" required>
                            <option value="">Selecione um</option>
                            <?php foreach ($salas as $sala): ?>
                                <option value="<?= $sala->id; ?>">
                                    <?= $sala->nome; ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                        <script>
                            $(function(){
                                setTimeout(() => {
                                    $('#id-sala').val('<?= ($input['id_sala'] ?? $agendamento->id_sala ?? null); ?>');
                                    $('#id-sala').change();
                                }, 100);
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="form-row">        
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="nome">
                            Data<span class="text-danger">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="data" 
                            id="data" 
                            class="form-control" 
                            value="<?= $input['data'] ?? $agendamento->data ?? ''; ?>" 
                            required
                        >
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="hora-inicio">
                            Hora de Início<span class="text-danger">*</span>
                        </label>
                        <input 
                            type="time" 
                            name="hora_inicio" 
                            id="hora-inicio" 
                            class="form-control" 
                            value="<?= $input['hora_inicio'] ?? (isset($agendamento->hora_inicio) ? date('H:i', strtotime($agendamento->hora_inicio)) : ''); ?>" 
                            required
                        >
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="hora-termino">
                            Hora de Término<span class="text-danger">*</span>
                        </label>
                        <input 
                            type="time" 
                            name="hora_termino" 
                            id="hora-termino" 
                            class="form-control" 
                            value="<?= $input['hora_termino'] ?? (isset($agendamento->hora_termino) ? date('H:i', strtotime($agendamento->hora_termino)) : ''); ?>" 
                            required
                        >
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="turma">
                            Turma<span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="turma" 
                            id="turma" 
                            class="form-control" 
                            value="<?= $input['turma'] ?? $agendamento->turma ?? ''; ?>" 
                            required
                        >
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="curso">
                            Curso<span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="curso" 
                            id="curso" 
                            class="form-control" 
                            value="<?= $input['curso'] ?? $agendamento->curso ?? ''; ?>" 
                            required
                        >
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="uc">
                            UC<span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="uc" 
                            id="uc" 
                            class="form-control" 
                            value="<?= $input['uc'] ?? $agendamento->uc ?? ''; ?>" 
                            required
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="justificativa">
                    Justificativa<span class="text-danger">*</span>
                </label>
                <textarea 
                    name="justificativa" 
                    id="justificativa" 
                    class="form-control" 
                    rows="6" 
                    required
                ><?= $input['justificativa'] ?? $agendamento->justificativa ?? ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary btn-icon-split">
                <span class="icon">
                    <i class="fa-regular fa-floppy-disk"></i> 
                </span>
                <span class="text">Salvar</span>
            </button>

            <a href="<?= route('agendamento'); ?>" class="btn btn-secondary btn-icon-split">
                <span class="icon">
                    <i class="fa-regular fa-arrow-left"></i> 
                </span>
                <span class="text">Voltar</span>
            </a>
        </form>
    </div>
</div>

<script>
    $(function(){
        $('#id-sala').change(function(){
            let id = $(this).val();

            if (!empty(id)) {
                $('#info-sala').show();

                $.ajax({
                    url: '<?= route('sala/obter'); ?>',
                    method: 'GET',
                    data: {
                        id: id
                    }
                }).then((response) => {
                    let sala = response.data;

                    $('#nome-sala').text(sala.nome);
                    $('#quantidade-maquina-sala').text(sala.quantidade_maquina);
                    $('#descricao-sala').text(sala.descricao ?? '-');

                    $('#tbody-disponibilidade').html('');
                    $.each(sala.disponibilidades, (index, disponibilidade) => {
                        $('#tbody-disponibilidade').append(`
                            <tr>
                                <td class="align-middle">${disponibilidade.nome_dia_semana}</td>
                                <td class="align-middle text-center">${date('%H:%i', time('1970-01-01 '+disponibilidade.hora_inicio))}</td>
                                <td class="align-middle text-center">${date('%H:%i', time('1970-01-01 '+disponibilidade.hora_termino))}</td>
                            </tr>
                        `);
                    });
                });
            } else {
                $('#info-sala').fadeOut(0);
            }
        });
    });
</script>