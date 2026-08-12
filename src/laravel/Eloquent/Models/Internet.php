<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKoneksi;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisLayananInternet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Internet extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'internet_id';

    protected function casts(): array
    {
        return [
            'bandwidth' => 'decimal',
            'bandwidth_up' => 'decimal',
            'bandwidth_down' => 'decimal',
            'latency' => 'integer',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.internet → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.internet → ref.jenis_koneksi (jenis_koneksi_id → jenis_koneksi_id).
     */
    public function jenisKoneksi(): BelongsTo
    {
        return $this->belongsTo(JenisKoneksi::class, 'jenis_koneksi_id', 'jenis_koneksi_id');
    }

    /**
     * public.internet → ref.jenis_layanan_internet (jenis_layanan_internet_id → jenis_layanan_internet_id).
     */
    public function jenisLayananInternet(): BelongsTo
    {
        return $this->belongsTo(JenisLayananInternet::class, 'jenis_layanan_internet_id', 'jenis_layanan_internet_id');
    }
}
