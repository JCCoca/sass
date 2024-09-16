<?php 

class Route 
{
    private static array $ROUTES = [
        'GET' => [], 
        'POST' => []
    ];

    public static function setGet(string $route, string $file, string $access = 'public'): void
    {
        self::$ROUTES['GET'][$route] = [
            'file' => $file,
            'access' => $access // public | auth | guest
        ];
    }

    public static function setPost(string $route, string $file, string $access = 'public'): void
    {
        self::$ROUTES['POST'][$route] = [
            'file' => $file,
            'access' => $access // public | auth | guest
        ];
    }

    public static function filter(string $page): string
    {
        return implode('/', array_filter(explode('/', $page)));
    }

    public static function getPage(): string 
    {
        if (isset($_GET['xpage'])) {
            return self::filter($_GET['xpage']);
        }
        return '';
    }

    public static function existsPage(?string $page = null): bool
    {
        $page = $page ?? self::getPage();
        return isset(self::$ROUTES[$_SERVER['REQUEST_METHOD']][$page]);
    }

    public static function getPageFile(?string $page = null): string 
    {
        $page = $page ?? self::getPage();
        return self::$ROUTES[$_SERVER['REQUEST_METHOD']][$page]['file'];
    }

    public static function hasPermission(?string $page = null): bool 
    {
        $page = $page ?? self::getPage();

        switch (strtolower(self::$ROUTES[$_SERVER['REQUEST_METHOD']][$page]['access'])) {
            case 'auth':
                return isAuth();
            case 'guest':
                return isGuest();
            default:
                return true;
        }
    }
}