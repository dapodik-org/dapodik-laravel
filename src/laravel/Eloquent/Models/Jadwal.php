<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['sekolah_id', 'semester_id', 'id_ruang'];

    protected function casts(): array
    {
        return [
            'hari' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_09 → pembelajaran_id).
     */
    public function belKe09(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_09', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.ruang (id_ruang → id_ruang).
     */
    public function ruang(): BelongsTo
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.jadwal → public.sekolah_longitudinal (sekolah_id → semester_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(SekolahLongitudinal::class, 'sekolah_id', 'semester_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_01 → pembelajaran_id).
     */
    public function belKe01(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_01', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_02 → pembelajaran_id).
     */
    public function belKe02(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_02', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_03 → pembelajaran_id).
     */
    public function belKe03(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_03', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_04 → pembelajaran_id).
     */
    public function belKe04(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_04', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_05 → pembelajaran_id).
     */
    public function belKe05(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_05', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_06 → pembelajaran_id).
     */
    public function belKe06(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_06', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_07 → pembelajaran_id).
     */
    public function belKe07(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_07', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_08 → pembelajaran_id).
     */
    public function belKe08(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_08', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_10 → pembelajaran_id).
     */
    public function belKe10(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_10', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_11 → pembelajaran_id).
     */
    public function belKe11(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_11', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_12 → pembelajaran_id).
     */
    public function belKe12(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_12', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_13 → pembelajaran_id).
     */
    public function belKe13(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_13', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_14 → pembelajaran_id).
     */
    public function belKe14(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_14', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_15 → pembelajaran_id).
     */
    public function belKe15(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_15', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_16 → pembelajaran_id).
     */
    public function belKe16(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_16', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_17 → pembelajaran_id).
     */
    public function belKe17(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_17', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_18 → pembelajaran_id).
     */
    public function belKe18(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_18', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_19 → pembelajaran_id).
     */
    public function belKe19(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_19', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.pembelajaran (bel_ke_20 → pembelajaran_id).
     */
    public function belKe20(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'bel_ke_20', 'pembelajaran_id');
    }

    /**
     * public.jadwal → public.sekolah_longitudinal (semester_id → sekolah_id).
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(SekolahLongitudinal::class, 'semester_id', 'sekolah_id');
    }
}
