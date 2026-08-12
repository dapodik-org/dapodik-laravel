<?php

namespace Dapodik\Laravel\Eloquent\Models\Nilai;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Pembelajaran;
use Dapodik\Laravel\Eloquent\Models\Ref\MataPelajaran;
use Dapodik\Laravel\Eloquent\Models\RombonganBelajar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatevRapor extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'id_evaluasi';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * nilai.matev_rapor ← nilai.nilai_rapor (id_evaluasi → id_evaluasi).
     */
    public function nilaiRapors(): HasMany
    {
        return $this->hasMany(NilaiRapor::class, 'id_evaluasi', 'id_evaluasi');
    }

    /**
     * nilai.matev_rapor → public.pembelajaran (pembelajaran_id → pembelajaran_id).
     */
    public function pembelajaran(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'pembelajaran_id', 'pembelajaran_id');
    }

    /**
     * nilai.matev_rapor → public.rombongan_belajar (rombongan_belajar_id → rombongan_belajar_id).
     */
    public function rombonganBelajar(): BelongsTo
    {
        return $this->belongsTo(RombonganBelajar::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    /**
     * nilai.matev_rapor → ref.mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }
}
