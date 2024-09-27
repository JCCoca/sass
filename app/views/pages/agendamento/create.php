<?php layout('admin/header', ['title' => 'Agendar Sala', 'active' => 'agendamento']); ?>

<h3 class="mb-3">Agendar Sala</h3>

<?php component('agendamento/form', [
    'action' => route('agendamento/cadastrar')
]); ?>

<?php layout('admin/footer'); ?>