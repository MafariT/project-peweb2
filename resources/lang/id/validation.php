<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi pesan kesalahan standar yang digunakan oleh
    | kelas validasi. Beberapa aturan memiliki beberapa versi, seperti aturan 'size'.
    | Silakan sesuaikan pesan-pesan ini sesuai kebutuhan aplikasi Anda.
    |
    */

    'accepted'        => ':attribute harus diterima.',
    'active_url'      => ':attribute bukan URL yang valid.',
    'after'           => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal'  => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha'           => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'      => ':attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num'       => ':attribute hanya boleh berisi huruf dan angka.',
    'array'           => ':attribute harus berupa array.',
    'before'          => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between'         => [
        'numeric' => ':attribute harus bernilai antara :min sampai :max.',
        'file'    => ':attribute harus berukuran antara :min sampai :max kilobita.',
        'string'  => ':attribute harus berisi antara :min sampai :max karakter.',
        'array'   => ':attribute harus memiliki antara :min sampai :max item.',
    ],
    'boolean'        => ':attribute harus bernilai true atau false.',
    'confirmed'      => 'Konfirmasi :attribute tidak cocok.',
    'date'           => ':attribute bukan tanggal yang valid.',
    'date_equals'    => ':attribute harus berupa tanggal yang sama dengan :date.',
    'date_format'    => ':attribute tidak cocok dengan format :format.',
    'different'      => ':attribute dan :other harus berbeda.',
    'digits'         => ':attribute harus terdiri dari :digits digit.',
    'digits_between' => ':attribute harus terdiri dari :min sampai :max digit.',
    'dimensions'     => ':attribute tidak memiliki dimensi gambar yang valid.',
    'distinct'       => ':attribute memiliki nilai duplikat.',
    'email'          => ':attribute harus berupa alamat email yang valid.',
    'ends_with'      => ':attribute harus diakhiri dengan salah satu dari berikut: :values.',
    'exists'         => ':attribute yang dipilih tidak valid.',
    'file'           => ':attribute harus berupa berkas.',
    'filled'         => ':attribute harus memiliki nilai.',
    'gt'             => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file'    => ':attribute harus lebih besar dari :value kilobita.',
        'string'  => ':attribute harus lebih panjang dari :value karakter.',
        'array'   => ':attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => ':attribute harus lebih besar dari atau sama dengan :value.',
        'file'    => ':attribute harus berukuran minimal :value kilobita.',
        'string'  => ':attribute harus berisi minimal :value karakter.',
        'array'   => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image'    => ':attribute harus berupa gambar.',
    'in'       => ':attribute yang dipilih tidak valid.',
    'in_array' => ':attribute tidak ditemukan dalam :other.',
    'integer'  => ':attribute harus berupa bilangan bulat.',
    'ip'       => ':attribute harus berupa alamat IP yang valid.',
    'ipv4'     => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'     => ':attribute harus berupa alamat IPv6 yang valid.',
    'json'     => ':attribute harus berupa string JSON yang valid.',
    'lt'       => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file'    => ':attribute harus kurang dari :value kilobita.',
        'string'  => ':attribute harus kurang dari :value karakter.',
        'array'   => ':attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'file'    => ':attribute harus berukuran maksimal :value kilobita.',
        'string'  => ':attribute harus berisi maksimal :value karakter.',
        'array'   => ':attribute tidak boleh lebih dari :value item.',
    ],
    'max' => [
        'numeric' => ':attribute maksimal bernilai :max.',
        'file'    => ':attribute maksimal berukuran :max kilobita.',
        'string'  => ':attribute maksimal berisi :max karakter.',
        'array'   => ':attribute maksimal terdiri dari :max item.',
    ],
    'mimes'     => ':attribute harus berupa berkas dengan tipe: :values.',
    'mimetypes' => ':attribute harus berupa berkas dengan tipe: :values.',
    'min'       => [
        'numeric' => ':attribute minimal bernilai :min.',
        'file'    => ':attribute minimal berukuran :min kilobita.',
        'string'  => ':attribute minimal berisi :min karakter.',
        'array'   => ':attribute minimal terdiri dari :min item.',
    ],
    'not_in'               => ':attribute yang dipilih tidak valid.',
    'not_regex'            => 'Format :attribute tidak valid.',
    'numeric'              => ':attribute harus berupa angka.',
    'password'             => 'Kata sandi salah.',
    'present'              => ':attribute wajib ada.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => ':attribute wajib diisi.',
    'required_if'          => ':attribute wajib diisi jika :other bernilai :value.',
    'required_unless'      => ':attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => ':attribute wajib diisi jika terdapat :values.',
    'required_with_all'    => ':attribute wajib diisi jika terdapat :values.',
    'required_without'     => ':attribute wajib diisi jika tidak terdapat :values.',
    'required_without_all' => ':attribute wajib diisi jika tidak ada satu pun dari :values.',
    'same'                 => ':attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => ':attribute harus bernilai :size.',
        'file'    => ':attribute harus berukuran :size kilobita.',
        'string'  => ':attribute harus berisi :size karakter.',
        'array'   => ':attribute harus terdiri dari :size item.',
    ],
    'starts_with' => ':attribute harus diawali dengan salah satu dari berikut: :values.',
    'string'      => ':attribute harus berupa teks.',
    'timezone'    => ':attribute harus berupa zona waktu yang valid.',
    'unique'      => ':attribute sudah digunakan.',
    'uploaded'    => ':attribute gagal diunggah.',
    'url'         => 'Format :attribute tidak valid.',
    'uuid'        => ':attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi khusus untuk atribut tertentu
    | menggunakan konvensi "attribute.rule" untuk menyesuaikan pesan ini secara spesifik.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pesan-khusus',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Kustom Nama Atribut
    |--------------------------------------------------------------------------
    |
    | Baris ini digunakan untuk mengganti placeholder atribut dengan nama yang
    | lebih ramah pembaca, seperti "Alamat Email" daripada hanya "email".
    |
    */

    'attributes' => [],
];
