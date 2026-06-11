<?php 
namespace App\Middleware;

class SessionMiddleware
{
    public function handle(): void
    {
        $timeout = 15 * 60;

        if (
            isset($_SESSION['LAST_ACTIVITY']) &&
            time() - $_SESSION['LAST_ACTIVITY'] > $timeout
        ) {

            session_destroy();

            header('Location: /login');

            exit;
        }

        $_SESSION['LAST_ACTIVITY'] = time();
    }
}