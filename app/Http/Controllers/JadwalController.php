<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class JadwalController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $jadwals = Auth::check()
            ? Jadwal::where('user_id', Auth::id())->get()
            : collect();


        // Summary cards
        $totalMataKuliah = $jadwals->pluck('mata_kuliah')->unique()->count();
        $totalDosen = $jadwals->pluck('dosen')->unique()->count();
        $totalJadwal = $jadwals->count();
        $totalRuangan = $jadwals->pluck('ruangan')->unique()->count();

        // Today’s info
        $now = Carbon::now()->locale('id');
        $todayName = ucfirst($now->translatedFormat('l')); // e.g., 'Senin'
        $todayTime = $now->format('H:i');

        $todayClasses = $jadwals->where('hari', $todayName);

        $nextClass = $todayClasses
            ->filter(fn ($jadwal) => $jadwal->jam_mulai > $todayTime)
            ->sortBy('jam_mulai')
            ->first();

        // Weekly load: count by day
        $weekDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $weeklyLoad = collect($weekDays)->mapWithKeys(function ($day) use ($jadwals) {
            return [$day => $jadwals->where('hari', $day)->count()];
        });

        return view('jadwal.dashboard', compact(
            'totalMataKuliah',
            'totalDosen',
            'totalJadwal',
            'totalRuangan',
            'todayClasses',
            'nextClass',
            'weeklyLoad',
            'todayName'
        ));
    }

    public function index(Request $request)
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        $jadwals = Auth::check()
            ? Jadwal::where('user_id', Auth::id())->get()
            : collect();

        $filterHari = $request->input('hari');
        $filterDosen = $request->input('dosen');
        $filterMataKuliah = $request->input('mata_kuliah');

        $filteredJadwals = $jadwals->filter(function ($jadwal) use ($filterHari, $filterDosen, $filterMataKuliah) {
            return (!$filterHari || $jadwal->hari === $filterHari)
                && (!$filterDosen || $jadwal->dosen === $filterDosen)
                && (!$filterMataKuliah || $jadwal->mata_kuliah === $filterMataKuliah);
        });

        $dosenList = $jadwals->pluck('dosen')->unique()->filter()->values();
        $mataKuliahList = $jadwals->pluck('mata_kuliah')->unique()->filter()->values();

        $dayMap = [
            'Senin' => 'Monday',
            'Selasa' => 'Tuesday',
            'Rabu' => 'Wednesday',
            'Kamis' => 'Thursday',
            'Jumat' => 'Friday',
        ];

        $calendarEvents = $filteredJadwals->map(function ($j) use ($dayMap) {
            $date = \Carbon\Carbon::parse("this week {$dayMap[$j->hari]}")->format('Y-m-d');
            return [
                'title' => "{$j->mata_kuliah} ({$j->ruangan})",
                'start' => "{$date}T{$j->jam_mulai}",
                'end' => "{$date}T{$j->jam_selesai}",
                'extendedProps' => ['dosen' => $j->dosen],
            ];
        })->values();

        return view('jadwal.index', compact(
            'days',
            'dosenList',
            'mataKuliahList',
            'filterHari',
            'filterDosen',
            'filterMataKuliah',
            'calendarEvents'
        ));
    }


    public function create()
    {
        return view('jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required',
            'dosen' => 'required',
            'ruangan' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Jadwal::create([
            'mata_kuliah' => $request->mata_kuliah,
            'dosen' => $request->dosen,
            'ruangan' => $request->ruangan,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('jadwal.create')->with('success', 'Jadwal created successfully.');
    }

    public function show(Jadwal $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403);
        }

        return view('jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403);
        }

        return view('jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'mata_kuliah' => 'required',
            'dosen' => 'required',
            'ruangan' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal->update($request->only([
            'mata_kuliah',
            'dosen',
            'ruangan',
            'hari',
            'jam_mulai',
            'jam_selesai',
        ]));

        return redirect()->route('jadwal.create')->with('success', 'Jadwal updated successfully.');
    }

    public function destroy(Jadwal $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403);
        }

        $jadwal->delete();
        return redirect()->route('jadwal.create')->with('success', 'Jadwal deleted successfully.');
    }
}

