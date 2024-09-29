<?php

$id = input('get', 'id', 'integer');

if (!empty($id)) {
    $result = DB::update('agendamento', [
        'excluido_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        $agendamento = getAgendamento($id);
        $gestores = getGestoresUnidade(getSession()['auth']['id_unidade']);

        sendMail($gestores, 'Agendamento Excluído - '.$agendamento->nome_sala, mailContent('agendamento/destroy', [
            'nomeOrientador' => $agendamento->nome_orientador,
            'nomeSala' => $agendamento->nome_sala,
            'curso' => $agendamento->curso, 
            'turma' => $agendamento->turma, 
            'uc' => $agendamento->uc,
            'data' => date('d/m/Y', strtotime($agendamento->data)),    
            'horaInicio' => date('H:i', strtotime($agendamento->hora_inicio)),
            'horaTermino' => date('H:i', strtotime($agendamento->hora_termino))
        ]));

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