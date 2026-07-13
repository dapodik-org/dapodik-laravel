<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kompetensi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_komp';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.kompetensi → ref.mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * ref.kompetensi → ref.kurikulum (kurikulum_id → kurikulum_id).
     */
    public function kurikulum(): BelongsTo
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id', 'kurikulum_id');
    }

    /**
     * ref.kompetensi → ref.tingkat_pendidikan (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */
    public function tingkatPendidikan(): BelongsTo
    {
        return $this->belongsTo(TingkatPendidikan::class, 'tingkat_pendidikan_id', 'tingkat_pendidikan_id');
    }

    /**
     * ref.kompetensi → ref.mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */

    /**
     * ref.kompetensi → ref.kompetensi (id_inti_dasar → id_komp).
     */
    public function intiDasar(): BelongsTo
    {
        return $this->belongsTo(self::class, 'id_inti_dasar', 'id_komp');
    }

    /**
     * ref.kompetensi → ref.kurikulum (kurikulum_id → kurikulum_id).
     */

    /**
     * ref.kompetensi → ref.tingkat_pendidikan (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */

    /**
     * ref.kompetensi ← ref.kompetensi (id_komp → id_inti_dasar).
     */
    public function kompetensis(): HasMany
    {
        return $this->hasMany(self::class, 'id_inti_dasar', 'id_komp');
    }
}
