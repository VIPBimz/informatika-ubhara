<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Tampilkan halaman direktori anggota portal publik (3 kategori: dosen, aslab, himatika).
     */
    public function index(Request $request): View
    {
        $categoryFilter = $request->query('kategori');

        $query = Member::where('is_published', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc');

        if ($categoryFilter && in_array($categoryFilter, ['dosen', 'aslab', 'himatika'])) {
            $query->where('kategori', $categoryFilter);
        }

        $members = $query->get();

        // Statistik / Ringkasan 3 kategori
        $stats = [
            'total' => Member::where('is_published', true)->count(),
            'dosen' => Member::where('is_published', true)->where('kategori', 'dosen')->count(),
            'aslab' => Member::where('is_published', true)->where('kategori', 'aslab')->count(),
            'himatika' => Member::where('is_published', true)->where('kategori', 'himatika')->count(),
        ];

        return view('anggota', compact('members', 'stats', 'categoryFilter'));
    }
}
