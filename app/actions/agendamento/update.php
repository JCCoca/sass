<?php

saveInputs();

$id = input('get', 'id', 'integer');
$idSala = input('post', 'id_sala', 'integer');
$data = input('post', 'data', 'date');
$horaInicio = input('post', 'hora_inicio', 'time');
$horaTermino = input('post', 'hora_termino', 'time');
$curso = input('post', 'curso');
$turma = input('post', 'turma');
$uc = input('post', 'uc');
$justificativa = input('post', 'justificativa');

if (
    !empty($id)
    and !empty($idSala)
    and !empty($data)
    and !empty($horaInicio)
    and !empty($horaTermino)
    and !empty($curso)
    and !empty($turma)
    and !empty($uc)
    and !empty($justificativa)
) {
    if (strtotime($data) < strtotime(date('Y-m-d'))) {
        redirect('agendamento/editar', [
            'id' => $id,
            'error' => 'A data de agendamento não pode ser anterior à data atual!'
        ]);
    }

    if (strtotime($data) > strtotime('+30 day', strtotime(date('Y-m-d')))) {
        redirect('agendamento/editar', [
            'id' => $id,
            'error' => 'A data do agendamento não pode exceder 30 dias a partir de hoje!'
        ]);
    }

    if (strtotime($horaInicio) >= strtotime($horaTermino)) {
        redirect('agendamento/editar', [
            'id' => $id,
            'error' => 'A hora de início deve ser menor que a de término!'
        ]);
    }

    if ((strtotime($data.' '.$horaInicio) - strtotime(date('Y-m-d H:i'))) < 3600) {
        redirect('agendamento/editar', [
            'id' => $id,
            'error' => 'Agendamento requer no mínimo uma hora de antecedência!'
        ]);
    }

    if ((strtotime($horaTermino) - strtotime($horaInicio)) < 3600) {
        redirect('agendamento/editar', [
            'id' => $id,
            'error' => 'Não é possível agendar uma sala por menos de uma hora!'
        ]);
    }

    if (verificaDisponibilidadeSala($idSala, $data, $horaInicio, $horaTermino)) {
        redirect('agendamento/editar', [
            'id' => $id,
            'error' => 'Esta sala não está disponível nesse dia ou horário!'
        ]);
    }

    if (verificaDisponibilidadeAgendamento($idSala, $data, $horaInicio, $horaTermino)) {
        redirect('agendamento/editar', [
            'id' => $id,
            'error' => 'Esta sala não está disponível nesse dia e horário, pois já está reservada!'
        ]);
    }

    $result = DB::update('agendamento', [
        'id_sala' => $idSala,
        'data' => $data,
        'hora_inicio' => $horaInicio,
        'hora_termino' => $horaTermino,
        'curso' => $curso,
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

        $gestores = getGestoresUnidade(getSession()['auth']['id_unidade']);
        $sala = getSala($idSala);

        sendMail($gestores, 'Agendamento Editado - '.$sala->nome, mailContent('agendamento/edit', [
            'nomeOrientador' => getSession()['auth']['nome'],
            'nomeSala' => $sala->nome,
            'curso' => $curso, 
            'turma' => $turma, 
            'uc' => $uc,
            'data' => date('d/m/Y', strtotime($data)),    
            'horaInicio' => date('H:i', strtotime($horaInicio)),
            'horaTermino' => date('H:i', strtotime($horaTermino)),
            'justificativa' => $justificativa
        ]));

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