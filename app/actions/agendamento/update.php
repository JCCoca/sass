<?php

saveInputs();

$id = input('get', 'id', 'integer');
$idSala = input('post', 'id_sala', 'integer');
$data = input('post', 'data', 'date');
$horaInicio = input('post', 'hora_inicio', 'time');
$horaTermino = input('post', 'hora_termino', 'time');
$turma = input('post', 'turma');
$uc = input('post', 'uc');
$justificativa = input('post', 'justificativa');

if (
    !empty($id)
    and !empty($idSala)
    and !empty($data)
    and !empty($horaInicio)
    and !empty($horaTermino)
    and !empty($turma)
    and !empty($uc)
    and !empty($justificativa)
) {
    if (strtotime($data) < strtotime(date('Y-m-d'))) {
        redirect('agendamento/cadastrar', [
            'error' => 'A data de agendamento não pode ser anterior à data atual!'
        ]);
    }

    if (strtotime($horaInicio) >= strtotime($horaTermino)) {
        redirect('agendamento/cadastrar', [
            'error' => 'A hora de início deve ser menor que a de término!'
        ]);
    }

    if ((strtotime($data.' '.$horaInicio) - strtotime(date('Y-m-d H:i'))) < 3600) {
        redirect('agendamento/cadastrar', [
            'error' => 'Agendamento requer no mínimo uma hora de antecedência!'
        ]);
    }

    if ((strtotime($horaTermino) - strtotime($horaInicio)) < 3600) {
        redirect('agendamento/cadastrar', [
            'error' => 'Não é possível agendar uma sala por menos de uma hora!'
        ]);
    }

    $result = DB::update('agendamento', [
        'id_sala' => $idSala,
        'data' => $data,
        'hora_inicio' => $horaInicio,
        'hora_termino' => $horaTermino,
        'turma' => $turma,
        'uc' => $uc,
        'justificativa' => $justificativa,
        'situacao' => 'Aguardando Confirmação',
        'atualizado_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        clearInputs();
        redirect('agendamento/editar', [
            'id' => $id,
            'success' => 'Edição realizada com sucesso!'
        ]);
    } else {
        redirect('agendamento/editar', [
            'id' => $id,
            'error' => 'Houve um erro ao tentar realizar a edição, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('agendamento/editar', [
        'id' => $id,
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}