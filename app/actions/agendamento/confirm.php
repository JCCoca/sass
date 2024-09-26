<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $result = DB::update('agendamento', [
        'situacao' => 'Aprovado',
        'id_gestor' => getSession()['auth']['id'],
        'atualizado_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        $agendamento = getAgendamento($id);
        sendMail(
            [
                [
                    'name' => $agendamento->nome_orientador,
                    'email' => $agendamento->email_orientador
                ]
            ], 
            'Agendamento Aprovado - '.$agendamento->nome_sala, 
            mailContent('agendamento/confirm', [
                'nomeOrientador' => $agendamento->nome_orientador,
                'nomeSala' => $agendamento->nome_sala,
                'curso' => $agendamento->curso, 
                'turma' => $agendamento->turma, 
                'uc' => $agendamento->uc,
                'data' => date('d/m/Y', strtotime($agendamento->data)),    
                'horaInicio' => date('H:i', strtotime($agendamento->hora_inicio)),
                'horaTermino' => date('H:i', strtotime($agendamento->hora_termino))
            ])
        );

        redirect('agendamento', [
            'success' => 'Agendamento aprovado com sucesso!'
        ]);
    } else {
        redirect('agendamento', [
            'error' => 'Houve um erro ao tentar realizar esta ação, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('agendamento', [
        'error' => 'Por favor, informe o ID!'
    ]);
}