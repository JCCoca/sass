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

function isAdministrador(): bool 
{
    return getSession()['auth']['id_perfil'] === 1;
}

function isGestor(): bool 
{
    return getSession()['auth']['id_perfil'] === 2;
}

function isOrientador(): bool 
{
    return getSession()['auth']['id_perfil'] === 3;
}