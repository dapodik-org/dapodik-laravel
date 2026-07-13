<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataPelajaranKurikulum extends Pivot
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'jumlah_jam' => 'decimal',
            'jumlah_jam_maksimum' => 'decimal',
            'wajib' => 'decimal',
            'sks' => 'decimal',
            'a_peminatan' => 'boolean',
        ];
    }

    /**
     * ref.mata_pelajaran_kurikulum → ref.status_di_kurikulum (status_di_kurikulum → status_di_kurikulum).
     */
    public function statusDiKurikulum(): BelongsTo
    {
        return $this->belongsTo(StatusDiKurikulum::class, 'status_di_kurikulum', 'status_di_kurikulum');
    }

    /**
     * ref.mata_pelajaran_kurikulum → ref.group_matpel (gmp_id → gmp_id).
     */
    public function gmp(): BelongsTo
    {
        return $this->belongsTo(GroupMatpel::class, 'gmp_id', 'gmp_id');
    }

    /**
     * ref.mata_pelajaran_kurikulum → ref.kurikulum (kurikulum_id → kurikulum_id).
     */
    public function kurikulum(): BelongsTo
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id', 'kurikulum_id');
    }

    /**
     * ref.mata_pelajaran_kurikulum → ref.mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * ref.mata_pelajaran_kurikulum → ref.tingkat_pendidikan (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */
    public function tingkatPendidikan(): BelongsTo
    {
        return $this->belongsTo(TingkatPendidikan::class, 'tingkat_pendidikan_id', 'tingkat_pendidikan_id');
    }
}
