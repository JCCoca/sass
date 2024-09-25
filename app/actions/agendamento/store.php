<?php

$idSala = input('post', 'id_sala', 'integer');
$data = input('post', 'data', 'date');
$horaInicio = input('post', 'hora_inicio', 'time');
$horaTermino = input('post', 'hora_termino', 'time');
$turma = input('post', 'turma');
$uc = input('post', 'uc');
$justificativa = input('post', 'justificativa');

if (
    !empty($idSala)
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

    $result = DB::create('agendamento', [
        'id_sala' => $idSala,
        'data' => $data,
        'hora_inicio' => $horaInicio,
        'hora_termino' => $horaTermino,
        'turma' => $turma,
        'uc' => $uc,
        'justificativa' => $justificativa,
        'situacao' => 'Aguardando Confirmação',
        'id_usuario' => getSession()['auth']['id'],
        'criado_em' => date('Y-m-d H:i:s')
    ]);

    if ($result !== false) {
        redirect('agendamento/cadastrar', [
            'success' => 'Cadastro realizado com sucesso!'
        ]);
    } else {
        redirect('agendamento/cadastrar', [
            'error' => 'Houve um erro ao tentar realizar o cadastro, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('agendamento/cadastrar', [
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}