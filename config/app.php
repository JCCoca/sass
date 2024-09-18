<?php 

// Defini o nome da aplicação
define('APP_NAME', 'Sistema de Agendamento de Sala');

// Defini se aplicação está em modo de debug
define('APP_DEBUG', true);

// Defini os tipos de erros da aplicação
if (APP_DEBUG) {
    error_reporting(E_ALL & ~E_NOTICE);
} else {
    error_reporting(0);
}

// Defini o fuso horário da aplicação
date_default_timezone_set('America/Rio_Branco');

// Defini a liguagem da aplicação
define('APP_LANGUAGE', 'pt-BR');

// Configuração do Idioma
setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "pt_BR.utf-8", "portuguese");

// Configuração monetária
setlocale(LC_MONETARY, "pt_BR");

// Configuração de conversão de Caracteres
setlocale(LC_CTYPE, "pt_BR.ISO-8859-1");

// Configuração de formato numérico
setlocale(LC_NUMERIC, "pt_BR.utf-8");

require_once 'database.php';
require_once 'route.php';
require_once 'session.php';