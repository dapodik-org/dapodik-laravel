<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMatpel extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'gmp_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.group_matpel → ref.kurikulum (kurikulum_id → kurikulum_id).
     */
    public function kurikulum(): BelongsTo
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id', 'kurikulum_id');
    }

    /**
     * ref.group_matpel → ref.tingkat_pendidikan (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */
    public function tingkatPendidikan(): BelongsTo
    {
        return $this->belongsTo(TingkatPendidikan::class, 'tingkat_pendidikan_id', 'tingkat_pendidikan_id');
    }

    /**
     * ref.group_matpel ← ref.mata_pelajaran_kurikulum (gmp_id → gmp_id).
     */
    public function mataPelajaranKurikulums(): HasMany
    {
        return $this->hasMany(MataPelajaranKurikulum::class, 'gmp_id', 'gmp_id');
    }
}
