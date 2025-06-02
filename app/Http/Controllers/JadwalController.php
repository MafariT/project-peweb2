<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $jadwals = Jadwal::where('user_id', $userId)->get();

        $totalMataKuliah = $jadwals->pluck('mata_kuliah')->unique()->count();
        $totalDosen = $jadwals->pluck('dosen')->unique()->count();
        $totalJadwal = $jadwals->count();
        $totalRuangan = $jadwals->pluck('ruangan')->unique()->count();

        return view('dashboard', compact(
            'jadwals',
            'totalMataKuliah',
            'totalDosen',
            'totalJadwal',
            'totalRuangan'
        ));
    }

    public function index()
    {
        $jadwals = Jadwal::where('user_id', Auth::id())->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $jadwals = Jadwal::where('user_id', Auth::id())->get();
        return view('jadwal.create', compact('jadwals'));
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

        return redirect()->route('jadwal.index')->with('success', 'Jadwal created successfully.');
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

        return redirect()->route('jadwal.index')->with('success', 'Jadwal updated successfully.');
    }

    public function destroy(Jadwal $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403);
        }

        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal deleted successfully.');
    }
}
