<?php
namespace App\Controllers;
use App\Core\View;

class HomeController 
{
    public function index() : void
    {
         View::render(
            'home/index',
            [
                'title' => 'ProSaúde'
            ],
            'public'
        );
    }

    public function sobre() : void
    {
         View::render(
            'home/sobre',
            [
                'title' => 'Sobre o ProSaúde'
            ],
            'public'
        );
    }
}