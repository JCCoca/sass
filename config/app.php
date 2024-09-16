<?php 

// Defini o nome da aplicação
define('APP_NAME', 'SASS');

// Defini se aplicação está em modo de debug
define('APP_DEBUG', true);

// Defini o fuso horário da aplicação
date_default_timezone_set('America/Rio_Branco');

// Defini os tipos de erros da aplicação
error_reporting(E_ERROR | E_WARNING);

require_once 'database.php';
require_once 'route.php';