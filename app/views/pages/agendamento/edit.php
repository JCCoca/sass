<?php layout('admin/header', ['title' => 'Editar Agendamento', 'active' => 'agendamento']); ?>

<?php

    $id = input('get', 'id', 'integer');

    $queryAgendamento = DB::query('SELECT * FROM agendamento WHERE id = :id AND situacao = "Aguardando Confirmação" AND excluido_em IS NULL', [':id' => $id]);

    if (empty($id) or $queryAgendamento->rowCount() == 0) {
        show401();
    }

?>

<h3 class="mb-3">Editar Agendamento</h3>

<?php component('agendamento/form', [
    'action' => route('agendamento/editar', ['id' => $id]),
    'agendamento' => $queryAgendamento->fetch()
]); ?>

<?php layout('admin/footer'); ?>