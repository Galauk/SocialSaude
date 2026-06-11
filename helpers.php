<?php

if (!function_exists('asset')) {

    function asset(string $path): string
    {
        return rtrim(
            $_ENV['APP_URL'],
            '/'
        ) . '/public/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('url')) {

    function url(string $path = ''): string
    {
        return rtrim(
            $_ENV['APP_URL'],
            '/'
        ) . '/' . ltrim($path, '/');
    }
}
function base_url(
    string $path = ''
): string {

    return rtrim(
        $_ENV['APP_URL'],
        '/'
    ) . '/' . ltrim($path, '/');
}

function redirect(
    string $url
): never {

    header(
        'Location: '
        . base_url($url)
    );

    exit;
}

function is_logged(): bool
{
    return isset(
        $_SESSION['usuario']
    );
}