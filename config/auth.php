<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        // nanti kalau mau guard lain (guru/siswa/admin) bisa ditambah di sini
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // ← HARUS User, bukan Guru
        ],

        // contoh kalau nanti mau provider terpisah:
        // 'gurus' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Models\Guru::class,
        // ],
        // 'siswas' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Models\Siswa::class,
        // ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
