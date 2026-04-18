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

    // Cari buku online dari Open Library API
    public function searchOnline(): string
    {
        $keyword = trim((string) $this->request->getGet('q'));
        $category = trim((string) $this->request->getGet('category'));

        $books = [];
        $error = null;

        if ($keyword !== '' || $category !== '') {
            $queryParts = [];

            if ($keyword !== '') {
                $queryParts[] = $keyword;
            }

            if ($category !== '') {
                $queryParts[] = $category;
            }

            $finalQuery = implode(' ', $queryParts);
            $url = 'https://openlibrary.org/search.json?q=' . urlencode($finalQuery);

            $response = @file_get_contents($url);

            if ($response === false) {
                $error = 'Gagal mengambil data dari Open Library API.';
            } else {
                $data = json_decode($response, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $error = 'Response API tidak valid.';
                } else {
                    $books = $data['docs'] ?? [];
                    $books = array_slice($books, 0, 12);
                }
            }
        }

        return view('books/search_online', [
            'title' => 'Cari Buku Online',
            'keyword' => $keyword,
            'category' => $category,
            'books' => $books,
            'error' => $error,
        ]);
    }
}