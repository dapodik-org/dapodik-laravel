<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SasaranPengawasan extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['pengawas_terdaftar_id', 'sekolah_id'];

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.sasaran_pengawasan → public.pengawas_terdaftar (pengawas_terdaftar_id → pengawas_terdaftar_id).
     */
    public function pengawasTerdaftar(): BelongsTo
    {
        return $this->belongsTo(PengawasTerdaftar::class, 'pengawas_terdaftar_id', 'pengawas_terdaftar_id');
    }

    /**
     * public.sasaran_pengawasan → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }
}
