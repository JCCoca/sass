<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    if (isOrientador()) {
        $result = DB::update('agendamento', [
            'excluido_em' => date('Y-m-d H:i:s')
        ], [
            'id' => $id
        ]);
    } else {
        $result = DB::update('agendamento', [
            'id_gestor' => getSession()['auth']['id'],
            'excluido_em' => date('Y-m-d H:i:s')
        ], [
            'id' => $id
        ]);
    }

    if ($result !== false) {
        $agendamento = getAgendamento($id);
        
        if (isOrientador()) {
            $gestores = getGestoresUnidade(getSession()['auth']['id_unidade']);

            sendMail($gestores, 'Agendamento Excluído - '.$agendamento->nome_sala, mailContent('agendamento/destroyOrientador', [
                'nomeOrientador' => $agendamento->nome_orientador,
                'nomeSala' => $agendamento->nome_sala,
                'curso' => $agendamento->curso, 
                'turma' => $agendamento->turma, 
                'uc' => $agendamento->uc,
                'data' => date('d/m/Y', strtotime($agendamento->data)),    
                'horaInicio' => date('H:i', strtotime($agendamento->hora_inicio)),
                'horaTermino' => date('H:i', strtotime($agendamento->hora_termino))
            ]));
        } else {
            sendMail(
                [
                    [
                        'name' => $agendamento->nome_orientador,
                        'email' => $agendamento->email_orientador
                    ]
                ], 'Agendamento Excluído - '.$agendamento->nome_sala, mailContent('agendamento/destroyGestor', [
                    'nomeOrientador' => $agendamento->nome_orientador,
                    'nomeGestor' => $agendamento->nome_gestor,
                    'nomeSala' => $agendamento->nome_sala,
                    'curso' => $agendamento->curso, 
                    'turma' => $agendamento->turma, 
                    'uc' => $agendamento->uc,
                    'data' => date('d/m/Y', strtotime($agendamento->data)),    
                    'horaInicio' => date('H:i', strtotime($agendamento->hora_inicio)),
                    'horaTermino' => date('H:i', strtotime($agendamento->hora_termino))
                ])
            );
        }

        redirect('agendamento', [
            'success' => 'Exclusão realizada com sucesso!'
        ]);
    } else {
        redirect('agendamento', [
            'error' => 'Houve um erro ao tentar realizar a exclusão, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('agendamento', [
        'error' => 'Por favor, informe o ID!'
    ]);
}