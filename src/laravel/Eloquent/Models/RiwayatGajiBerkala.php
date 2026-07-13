<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatGajiBerkala extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'riwayat_gaji_berkala_id';

    protected function casts(): array
    {
        return [
            'tanggal_sk' => 'date',
            'tmt_kgb' => 'date',
            'masa_kerja_tahun' => 'decimal',
            'masa_kerja_bulan' => 'decimal',
            'gaji_pokok' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.riwayat_gaji_berkala → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }
}
