<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;

class HomeController
{
    public function index(): string
    {
        return View::render('home', ['titre' => 'Bienvenue à la bibliothèque']);
    }
}
