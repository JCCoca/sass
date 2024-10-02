<h1 class="text-center" style="margin-bottom: 30px">Relatório de Agendamentos</h1>

<div class="box">
    <h4 style="margin-bottom: 5px">Filtros:</h4>

    <div>
        <?php if ($sala !== null): ?>
            <span>
                Sala: <?= $sala->nome; ?>
            </span>
        <?php endif; ?>
        <span>
            Periodo: <?= date('d/m/Y', strtotime($dataInicio)); ?> à <?=  date('d/m/Y', strtotime($dataTermino)); ?>
        </span>
    </div>
</div>

<table class="table">
    <thead class="table-thead">
        <tr>
            <th>Orientador(a)</th>
            <th>Sala</th>
            <th class="text-center">Data</th>
            <th class="text-center">Entrada</th>
            <th class="text-center">Saída</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($agendamentos as $agendamento): ?>
            <tr>
                <td>
                    <?= $agendamento->nome_orientador; ?>
                </td>
                <td>
                    <?= $agendamento->nome_sala; ?>
                </td>
                <td class="text-center">
                    <?= date('d/m/Y', strtotime($agendamento->data)); ?>
                </td>
                <td class="text-center">
                    <?= date('H:i', strtotime($agendamento->hora_inicio)); ?>
                </td>
                <td class="text-center">
                    <?= date('H:i', strtotime($agendamento->hora_termino)); ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>