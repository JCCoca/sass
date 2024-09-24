<?php

$id = input('get', 'id', 'integer');
$idDiaSemana = input('post', 'id_dia_semana', 'integer');
$horaInicio = input('post', 'hora_inicio', 'time');
$horaTermino = input('post', 'hora_termino', 'time');
$idSala = input('post', 'id_sala', 'integer');

if (
    !empty($id)
    and !empty($idDiaSemana)
    and !empty($horaInicio)
    and !empty($horaTermino)
    and !empty($idSala)
) {
    $result = DB::update('disponibilidade_sala', [
        'id_dia_semana' => $idDiaSemana,
        'hora_inicio' => $horaInicio,
        'hora_termino' => $horaTermino,
        'atualizado_em' => date('Y-m-d H:i:s')
    ], [
        'id' => $id
    ]);

    if ($result !== false) {
        redirect('sala/disponibilidade/editar', [
            'id' => $id,
            'id_sala' => $idSala,
            'success' => 'Edição realizada com sucesso!'
        ]);
    } else {
        redirect('sala/disponibilidade/editar', [
            'id' => $id,
            'id_sala' => $idSala,
            'error' => 'Houve um erro ao tentar realizar a edição, por favor tente mais tarde!'
        ]);
    }
} else {
    redirect('sala/disponibilidade/editar', [
        'id' => $id,
        'id_sala' => $idSala,
        'error' => 'Preencha todos os campos obrigatórios!'
    ]);
}