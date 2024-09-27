<?php 

// Define o nome da sessão
define('SESSION_NAME', $_ENV['SESSION_NAME'] ?? 'SESSION_ID');

// Define o tempo da sessão
define('MAX_SESSION_TIME', $_ENV['MAX_SESSION_TIME'] ?? 3600);

// Configuração da sessão
session_name(SESSION_NAME);
ini_set("session.gc_maxlifetime", MAX_SESSION_TIME);
ini_set("session.cookie_lifetime", MAX_SESSION_TIME);