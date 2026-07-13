<?php

return [

    /*
     * Prefix tabel.
     */
    'prefix' => env('DAPODIK_ELOQUENT_PREFIX', 'dapodik'),

    /*
     * Suffix tabel.
     */
    'suffix' => env('DAPODIK_ELOQUENT_SUFFIX', null),

    /*
     * Nama koneksi database Laravel (dari config/database.php).
     * Biarkan null untuk menggunakan koneksi default.
     */
    'connection' => env('DAPODIK_ELOQUENT_CONNECTION', null),

    /*
     * Pisahkan koneksi per subdirektori model.
     */
    'split_connection' => env('DAPODIK_ELOQUENT_SPLIT_CONNECTION', false),

    /*
     * Lewati drop tabel saat migrate:fresh
     */
    'skip_fresh' => env('DAPODIK_ELOQUENT_SKIP_FRESH', false),

    /*
     * Exclude Tabel dari Migration
     */
    'exclude_tables' => [
        'eloquent_sync_status',
    ],

];
