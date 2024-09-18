<?php 

// Define o nome da sessão
define('SESSION_NAME', 'SESSION_SASS_ID');

// Define o tempo da sessão
define('MAX_SESSION_TIME', 3600);

// Configuração da sessão
session_name(SESSION_NAME);
ini_set("session.gc_maxlifetime", MAX_SESSION_TIME);
ini_set("session.cookie_lifetime", MAX_SESSION_TIME);