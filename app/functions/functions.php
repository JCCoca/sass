<?php

function abreviarNome(string $nomeCompleto): string
{
    $artigos = ['da', 'de', 'do', 'das', 'dos', 'e'];

    $nomes = explode(' ', $nomeCompleto);

    $nomesFiltrados = array_filter($nomes, function($nome) use ($artigos) {
        return !in_array(strtolower($nome), $artigos);
    });

    $abreviado = array_slice($nomesFiltrados, 0, 2);

    return implode(' ', $abreviado);
}
