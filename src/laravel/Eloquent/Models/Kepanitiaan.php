<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kepanitiaan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_panitia';

    protected function casts(): array
    {
        return [
            'id_jns_panitia' => 'integer',
            'tmt_sk_tugas' => 'date',
            'tst_sk_tugas' => 'date',
            'a_pasang_papan' => 'decimal',
            'a_formulir' => 'decimal',
            'a_silabus' => 'decimal',
            'a_berlaku_pos' => 'decimal',
            'a_sosialisasi_pos' => 'decimal',
            'a_ks_edukatif' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.kepanitiaan → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.kepanitiaan ← public.aktivitas_kepanitiaan (id_panitia → id_panitia).
     */
    public function aktivitasKepanitiaans(): HasMany
    {
        return $this->hasMany(AktivitasKepanitiaan::class, 'id_panitia', 'id_panitia');
    }

    /**
     * public.kepanitiaan ← public.anggota_panitia (id_panitia → id_panitia).
     */
    public function anggotaPanitias(): HasMany
    {
        return $this->hasMany(AnggotaPanitia::class, 'id_panitia', 'id_panitia');
    }
}
