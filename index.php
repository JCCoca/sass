<?php

global $_ENV;

$_ENV = [];
if (file_exists('.env') == true) {
    $_ENV = parse_ini_file('.env', false, INI_SCANNER_TYPED);
}

require_once 'config/app.php';
require_once 'system/autoload.php';
require_once 'vendor/autoload.php';
require_once 'routes/web.php';
require_once 'app/functions/autoload.php';

ob_start();

try {
    if (Route::existsPage()) {
        if (Route::hasAccess()) {
            if (Route::hasPermission()) {
                require_once Route::getPageFile();
            } else {
                show401();
            }
        } else {
            redirect('login');
        }
    } else {
        show404();
    }
} catch (Throwable $error) {
    show500($error);
} catch (PDOException $error) {
    show500($error);
}

ob_end_flush();