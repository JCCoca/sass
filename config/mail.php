<?php 

// Nome do usuário do e-mail
define('MAIL_USERNAME', 'Não Responda | '.APP_NAME);

// Configurações de conexão com provedor de e-mail
define('MAIL_DEBUG', $_ENV['MAIL_DEBUG'] ?? false);
define('MAIL_HOST', $_ENV['MAIL_HOST'] ?? '');
define('MAIL_PORT', $_ENV['MAIL_PORT'] ?? 587);
define('MAIL_ENCRYPTION', $_ENV['MAIL_ENCRYPTION'] ?? 'TLS');
define('MAIL_ADDRESS', $_ENV['MAIL_ADDRESS'] ?? '');
define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD'] ?? '');