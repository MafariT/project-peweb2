<form action="{{ isset($jadwal) ? route('jadwal.update', $jadwal) : route('jadwal.store') }}" method="POST" class="space-y-4">
    @csrf
    @if(isset($jadwal)) @method('PUT') @endif

    <div>
        <label class="block text-sm mb-1">Mata Kuliah</label>
        <input type="text" name="mata_kuliah" class="w-full rounded border border-gray-700 p-2" value="{{ old('mata_kuliah', $jadwal->mata_kuliah ?? '') }}" required>
    </div>

    <div>
        <label class="block text-sm mb-1">Dosen</label>
        <input type="text" name="dosen" class="w-full rounded border border-gray-700 p-2" value="{{ old('dosen', $jadwal->dosen ?? '') }}" required>
    </div>

    <div>
        <label class="block text-sm mb-1">Ruangan</label>
        <input type="text" name="ruangan" class="w-full rounded border border-gray-700 p-2" value="{{ old('ruangan', $jadwal->ruangan ?? '') }}" required>
    </div>

    <div>
        <label class="block text-sm mb-1">Hari</label>
        <select name="hari" class="w-full rounded border border-gray-700 p-2" required>
            @php
                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
            @endphp
            @foreach ($days as $day)
                <option value="{{ $day }}" {{ old('hari', $jadwal->hari ?? '') === $day ? 'selected' : '' }}>{{ $day }}</option>
            @endforeach
        </select>
    </div>


    <div>
        <label class="block text-sm mb-1">Jam Mulai</label>
        <input type="time" name="jam_mulai" class="w-full rounded border border-gray-700 p-2" value="{{ old('jam_mulai', $jadwal->jam_mulai ?? '') }}" required>
    </div>

    <div>
        <label class="block text-sm mb-1">Jam Selesai</label>
        <input type="time" name="jam_selesai" class="w-full rounded border border-gray-700 p-2" value="{{ old('jam_selesai', $jadwal->jam_selesai ?? '') }}" required>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            {{ isset($jadwal) ? 'Update' : 'Simpan' }}
        </button>
    </div>
</form>
