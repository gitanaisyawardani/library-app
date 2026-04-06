<?php

namespace App\Controllers;

use App\Services\LibraryService;

class MemberController extends BaseController
{
    protected LibraryService $library;

    public function __construct()
    {
        $this->library = new LibraryService();
    }

    // Tampilkan daftar member
    public function index(): string
    {
        $result = $this->library->getMembers();

        return view('members/index', [
            'title' => 'Daftar Member',
            'members' => $result['data'] ?? [],
            'error' => $result['error'] ?? null,
        ]);
    }

    // Detail member
    public function detail(int $id): string
    {
        $result = $this->library->getMember($id);

        return view('members/detail', [
            'title' => 'Detail Member',
            'member' => $result['data'] ?? null,
            'error' => $result['error'] ?? null,
        ]);
    }
}