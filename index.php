<?php

require_once 'config/app.php';
require_once 'system/Route.php';
require_once 'system/FileManager.php';
require_once 'system/functions.php';
require_once 'routes/web.php';
require_once 'database/Connection.php';
require_once 'database/DB.php';
require_once 'app/functions/autoload.php';

ob_start();

try {
    if (Route::existsPage()) {
        if (Route::hasPermission()) {
            require_once Route::getPageFile();
        } else {
            show401();
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