<?php

saveInputs();

$idSala = input('post', 'id_sala', 'integer');
$data = input('post', 'data', 'date');
$horaInicio = input('post', 'hora_inicio', 'time');
$horaTermino = input('post', 'hora_termino', 'time');
$curso = input('post', 'curso');
$turma = input('post', 'turma');
$uc = input('post', 'uc');
$justificativa = input('post', 'justificativa');

if (
    !empty($idSala)
    and !empty($data)
    and !empty($horaInicio)
    and !empty($horaTermino)
    and !empty($curso)
    and !empty($turma)
    and !empty($uc)
    and !empty($justificativa)
) {
    if (strtotime($data) < strtotime(date('Y-m-d'))) {
        redirect('agendamento/cadastrar', [
            'error' => 'A data de agendamento não pode ser anterior à data atual!'
        ]);
    }

    if (strtotime($data) > strtotime('+30 day', strtotime(date('Y-m-d')))) {
        redirect('agendamento/cadastrar', [
            'error' => 'A data do agendamento não pode exceder 30 dias a partir de hoje!'
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

    if (!verificaDisponibilidadeSala($idSala, $data, $horaInicio, $horaTermino)) {
        redirect('agendamento/cadastrar', [
            'error' => 'Esta sala não está disponível nesse dia ou horário!'
        ]);
    }

    $result = DB::create('agendamento', [
        'id_sala' => $idSala,
        'data' => $data,
        'hora_inicio' => $horaInicio,
        'hora_termino' => $horaTermino,
        'curso' => $curso,
        'turma' => $turma,
        'uc' => $uc,
        'justificativa' => $justificativa,
        'situacao' => 'Aguardando Confirmação',
        'id_orientador' => getSession()['auth']['id'],
        'criado_em' => date('Y-m-d H:i:s')
    ]);

    if ($result !== false) {
        clearInputs();

        $gestores = DB::query('SELECT nome AS name, email FROM usuario WHERE id_perfil = 2 AND id_unidade = :idUnidade AND excluido_em IS NULL', [
            ':idUnidade' => getSession()['auth']['id_unidade']
        ])->fetchAll(PDO::FETCH_ASSOC);

        $sala = getSala($idSala);
        sendMail($gestores, 'Solicitação de Agendamento do(a) '.$sala->nome, mailContent('agendamento/create', [
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