<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Kuliah Hari Ini</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 20px;">
        <h2 style="color: #0055a5;">Halo, {{ $user->name }}! 👋</h2>

        <p>Berikut adalah jadwal kuliah kamu untuk hari <strong>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</strong>:</p>

        @if($jadwal->isEmpty())
            <p style="color: #888;">Kamu tidak memiliki jadwal kuliah hari ini.</p>
        @else
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background-color: #0055a5; color: #ffffff;">
                        <th style="padding: 10px; text-align: left;">Mata Kuliah</th>
                        <th style="padding: 10px; text-align: left;">Jam</th>
                        <th style="padding: 10px; text-align: left;">Ruang</th>
                        <th style="padding: 10px; text-align: left;">Dosen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $item)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;">{{ $item->mata_kuliah }}</td>
                            <td style="padding: 10px;">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td style="padding: 10px;">{{ $item->ruangan ?? '-' }}</td>
                            <td style="padding: 10px;">{{ $item->dosen ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <p style="margin-top: 30px;">Semoga harimu produktif dan menyenangkan! 🎓</p>

        <p style="color: #aaa; font-size: 12px; text-align: center; margin-top: 40px;">
            Email ini dikirim secara otomatis oleh sistem Jadwal Kuliah PlanMyClass. Mohon untuk tidak membalas email ini.
        </p>
    </div>
</body>
</html>
