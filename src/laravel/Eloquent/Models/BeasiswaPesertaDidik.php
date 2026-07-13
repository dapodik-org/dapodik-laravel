<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BeasiswaPesertaDidik extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'beasiswa_peserta_didik_id';

    protected function casts(): array
    {
        return [
            'tahun_mulai' => 'decimal',
            'tahun_selesai' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.beasiswa_peserta_didik → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.beasiswa_peserta_didik ← public.vld_bea_pd (beasiswa_peserta_didik_id → beasiswa_peserta_didik_id).
     */
    public function vldBeaPds(): HasMany
    {
        return $this->hasMany(VldBeaPd::class, 'beasiswa_peserta_didik_id', 'beasiswa_peserta_didik_id');
    }
}
