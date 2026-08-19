<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\BookRepositoryInterface;
use Core\View;

class BookController
{
    public function __construct(private BookRepositoryInterface $repository) {}

    public function index(): string
    {
        $livres = $this->repository->findAll();
        return View::render('books', ['livres' => $livres]);
    }
}
