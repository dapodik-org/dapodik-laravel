<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruSasaranPengawas extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['pengawas_terdaftar_id', 'ptk_terdaftar_id'];

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.guru_sasaran_pengawas → public.ptk_terdaftar (ptk_terdaftar_id → ptk_terdaftar_id).
     */
    public function ptkTerdaftar(): BelongsTo
    {
        return $this->belongsTo(PtkTerdaftar::class, 'ptk_terdaftar_id', 'ptk_terdaftar_id');
    }

    /**
     * public.guru_sasaran_pengawas → public.pengawas_terdaftar (pengawas_terdaftar_id → pengawas_terdaftar_id).
     */
    public function pengawasTerdaftar(): BelongsTo
    {
        return $this->belongsTo(PengawasTerdaftar::class, 'pengawas_terdaftar_id', 'pengawas_terdaftar_id');
    }
}
