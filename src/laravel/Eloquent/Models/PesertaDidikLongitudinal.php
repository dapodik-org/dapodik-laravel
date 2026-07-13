<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesertaDidikLongitudinal extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['peserta_didik_id', 'semester_id'];

    protected function casts(): array
    {
        return [
            'tinggi_badan' => 'decimal',
            'berat_badan' => 'decimal',
            'lingkar_kepala' => 'decimal',
            'jarak_rumah_ke_sekolah' => 'decimal',
            'jarak_rumah_ke_sekolah_km' => 'decimal',
            'waktu_tempuh_ke_sekolah' => 'decimal',
            'menit_tempuh_ke_sekolah' => 'decimal',
            'jumlah_saudara_kandung' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.peserta_didik_longitudinal → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik_longitudinal ← public.vld_pd_long (peserta_didik_id → semester_id).
     */
    public function vldPdLongs(): HasMany
    {
        return $this->hasMany(VldPdLong::class, 'semester_id', 'peserta_didik_id');
    }
}
