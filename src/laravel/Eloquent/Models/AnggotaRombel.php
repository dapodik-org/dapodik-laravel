<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnggotaRombel extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'anggota_rombel_id';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.anggota_rombel → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.anggota_rombel → public.rombongan_belajar (rombongan_belajar_id → rombongan_belajar_id).
     */
    public function rombonganBelajar(): BelongsTo
    {
        return $this->belongsTo(RombonganBelajar::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    /**
     * public.anggota_rombel ← public.bantuan_pd (anggota_rombel_id → anggota_rombel_id).
     */
    public function bantuanPds(): HasMany
    {
        return $this->hasMany(BantuanPd::class, 'anggota_rombel_id', 'anggota_rombel_id');
    }
}
