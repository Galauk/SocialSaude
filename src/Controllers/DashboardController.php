<?php
namespace App\Controllers;
use App\Core\View;

class DashboardController 
{
    public function index()
    {
        View::render(
            'dashboard/index',
            [
                'title' => 'ProSaúde'
            ],
            'app'
        );
    }
}
