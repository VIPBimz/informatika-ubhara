<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Lab;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    /**
     * Tampilkan halaman absensi publik beserta data presensi hari ini.
     */
    public function index(): View
    {
        $today = now()->toDateString();

        $attendances = Attendance::with('lab')
            ->whereDate('tanggal', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        $labs = Lab::where('status', 'aktif')->orderBy('nama')->get();
        $todayCount = $attendances->count();

        return view('absensi', compact('attendances', 'labs', 'todayCount'));
    }

    /**
     * Simpan data presensi baru dari formulir publik.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:20'],
            'nama' => ['required', 'string', 'max:150'],
            'tujuan' => ['required', 'string', 'max:255'],
            'lab_id' => ['nullable', 'exists:labs,id'],
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nama.required' => 'Nama lengkap mahasiswa wajib diisi.',
            'tujuan.required' => 'Tujuan masuk laboratorium wajib diisi.',
            'lab_id.exists' => 'Laboratorium yang dipilih tidak valid.',
        ]);

        $attendance = Attendance::create([
            'nim' => trim($validated['nim']),
            'nama' => trim($validated['nama']),
            'tujuan' => trim($validated['tujuan']),
            'lab_id' => $validated['lab_id'] ?? null,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->format('H:i:s'),
        ]);

        // Load relasi lab untuk response
        $attendance->load('lab');

        return response()->json([
            'success' => true,
            'message' => 'Presensi berhasil disimpan!',
            'data' => [
                'id' => $attendance->id,
                'nim' => $attendance->nim,
                'nama' => $attendance->nama,
                'tujuan' => $attendance->tujuan,
                'lab_nama' => $attendance->lab ? $attendance->lab->nama : 'Umum / Semua Lab',
                'jam' => substr($attendance->jam_masuk, 0, 5) . ' WIB',
                'tanggal' => date('d M Y', strtotime($attendance->tanggal)),
            ],
            'total_today' => Attendance::whereDate('tanggal', now()->toDateString())->count(),
        ], 201);
    }

    /**
     * Endpoint API AJAX untuk mengambil data kehadiran hari ini secara realtime.
     */
    public function todayList(): JsonResponse
    {
        $attendances = Attendance::with('lab')
            ->whereDate('tanggal', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nim' => $item->nim,
                    'nama' => $item->nama,
                    'tujuan' => $item->tujuan,
                    'lab_nama' => $item->lab ? $item->lab->nama : null,
                    'jam' => substr($item->jam_masuk, 0, 5) . ' WIB',
                ];
            });

        return response()->json([
            'success' => true,
            'total' => $attendances->count(),
            'data' => $attendances,
        ]);
    }
}
