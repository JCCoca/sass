<?php

$id = input('get', 'id', 'integer');
$justificativaRecusa = input('post', 'justificativa');

if (!empty($id) and !empty($justificativaRecusa)) {
    $result = DB::update('agendamento', [
        'situacao' => 'Recusado',
        'id_gestor' => getSession()['auth']['id'],
        'justificativa_recusa' => $justificativaRecusa,
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
            'Agendamento Recusado - '.$agendamento->nome_sala, 
            mailContent('agendamento/reject', [
                'nomeOrientador' => $agendamento->nome_orientador,
                'nomeSala' => $agendamento->nome_sala,
                'curso' => $agendamento->curso, 
                'turma' => $agendamento->turma, 
                'uc' => $agendamento->uc,
                'data' => date('d/m/Y', strtotime($agendamento->data)),    
                'horaInicio' => date('H:i', strtotime($agendamento->hora_inicio)),
                'horaTermino' => date('H:i', strtotime($agendamento->hora_termino)),
                'justificativaRecusa' => $agendamento->justificativa_recusa
            ])
        );

        redirect('agendamento', [
            'success' => 'Agendamento recusado com sucesso!!'
        ]);
    } else {
        redirect('agendamento', [
            'error' => 'Houve um erro ao tentar realizar esta ação, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('agendamento', [
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}