<?php

function title(?string $title = '', string $separator = '|'): string
{
    return !empty($title) ? "{$title} {$separator} ".APP_NAME : APP_NAME;
}

function actions(string $dirFile): string
{
    return DIR_ACTIONS."/{$dirFile}.php";
}

function pages(string $dirFile): string
{
    return DIR_PAGES."/{$dirFile}.php";
}

function getHost(): string
{
    return (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
}

function asset(string $dirFile): string
{
    return getHost().APP_BASE_PATH.'/public/assets/'.$dirFile;
}

function storage(string $dirFile): string
{
    return getHost().APP_BASE_PATH.$dirFile;
}

function layout(string $dirFile, array $data = []): void
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    include "./app/views/layouts/{$dirFile}.php";
}

function component(string $dirFile, array $data = []): void
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    include_once "./app/views/components/{$dirFile}.php";
}

function route(string $page, ?array $data = null): string
{
    $baseURL = getHost().APP_BASE_PATH.'/'.Route::filter($page);

    if ($data !== null) {
        return $baseURL.'?'.http_build_query($data);
    }

    return $baseURL;
}

function redirect(string $page, ?array $data = null): void
{
    header('Location: '.route($page, $data));
    exit();
}

function show401(): void 
{
    ob_clean();
    http_response_code(401);
    require_once 'app/views/errors/401.php';
    ob_end_flush();
    exit();
}

function show403(): void 
{
    ob_clean();
    http_response_code(403);
    require_once 'app/views/errors/403.php';
    ob_end_flush();
    exit();
}

function show404(): void 
{
    ob_clean();
    http_response_code(404);
    require_once 'app/views/errors/404.php';
    ob_end_flush();
    exit();
}

function show500(?object $error = null): void 
{
    ob_clean();
    http_response_code(500);
    require_once 'app/views/errors/500.php';
    ob_end_flush();
    exit();
}

function getSession(): array
{
    session_start();
    $session = $_SESSION;
    session_write_close();

    return $session;
}

function setSession(string $key, $value): void
{
    session_start();
    $_SESSION[$key] = $value;
    session_write_close();
}

function destroySession(): void
{
    session_start();
    session_destroy();
    session_write_close();
}

function regenerateIdSession(): void
{
    session_start();
    session_regenerate_id();
    session_write_close();
}

function isAuth(): bool
{
    $session = getSession();
    return isset($session['auth']) and !empty($session['auth']);
}

function isGuest(): bool
{
    $session = getSession();
    return !isset($session['auth']) or empty($session['auth']);
}

function input(string $method = 'GET', string $key, string $type = 'string'): string|int|float|bool
{
    $input = strtoupper($method) === 'GET' ? $_GET : $_POST;
    $value = trim(strval($input[$key]));

    switch (strtolower($type)) {
        case 'string':
            return htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
        case 'int':
        case 'integer':
            return intval(filter_var($value, FILTER_VALIDATE_INT, [
                'options' => [
                    'min_range' => PHP_INT_MIN,
                    'max_range' => PHP_INT_MAX
                ]
            ]));
        case 'double':
        case 'float':
            return floatval(filter_var($value, FILTER_VALIDATE_FLOAT));
        case 'money':
            return floatval(filter_var(str_replace(',', '.', str_replace('.', '', $value)), FILTER_VALIDATE_FLOAT));
        case 'email':
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        case 'url':
            return filter_var($value, FILTER_VALIDATE_URL);
        case 'bool':
        case 'boolean':
            return boolval(filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE));
        case 'default':
        default:
            return $value;
    }
}

function hasInput(string $method = 'GET', string $key): bool
{
    $input = strtoupper($method) === 'GET' ? $_GET : $_POST;
    return isset($input[$key]);
}

function responseJson(array $content, int $code = 200): void
{
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($code);
    echo json_encode($content);
}