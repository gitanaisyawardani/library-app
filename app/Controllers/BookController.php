<?php

namespace App\Controllers;

use App\Services\LibraryService;

class BookController extends BaseController
{
    protected LibraryService $library;

    public function __construct()
    {
        $this->library = new LibraryService();
    }

    // Tampilkan daftar buku
    public function index(): string
    {
        $search = $this->request->getGet('search');
        $params = $search ? ['search' => $search] : [];

        $result = $this->library->getBooks($params);

        return view('books/index', [
            'title' => 'Daftar Buku Perpustakaan',
            'books' => $result['data'] ?? [],
            'error' => $result['error'] ?? null,
        ]);
    }

    // Detail buku
    public function detail(int $id): string
    {
        $result = $this->library->getBook($id);

        return view('books/detail', [
            'title' => 'Detail Buku',
            'book' => $result['data'] ?? null,
            'error' => $result['error'] ?? null,
        ]);
    }
}