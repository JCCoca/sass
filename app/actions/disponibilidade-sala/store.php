<?php

$idDiaSemana = input('post', 'id_dia_semana', 'integer');
$horaInicio = input('post', 'hora_inicio', 'time');
$horaTermino = input('post', 'hora_termino', 'time');
$idSala = input('post', 'id_sala', 'integer');

if (
    !empty($idDiaSemana)
    and !empty($horaInicio)
    and !empty($horaTermino)
    and !empty($idSala)
) {
    if (strtotime($horaInicio) >= strtotime($horaTermino)) {
        redirect('sala/disponibilidade/cadastrar', [
            'id_sala' => $idSala,
            'error' => 'A hora de início deve ser menor que a de término!'
        ]);
    }

    $result = DB::create('disponibilidade_sala', [
        'id_dia_semana' => $idDiaSemana,
        'hora_inicio' => $horaInicio,
        'hora_termino' => $horaTermino,
        'id_sala' => $idSala,
        'criado_em' => date('Y-m-d H:i:s')
    ]);

    if ($result !== false) {
        redirect('sala/disponibilidade/cadastrar', [
            'id_sala' => $idSala,
            'success' => 'Cadastro realizado com sucesso!'
        ]);
    } else {
        redirect('sala/disponibilidade/cadastrar', [
            'id_sala' => $idSala,
            'error' => 'Houve um erro ao tentar realizar o cadastro, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('sala/disponibilidade/cadastrar', [
        'id_sala' => $idSala,
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}