<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisSarana extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jenis_sarana_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'perlu_penempatan' => 'boolean',
            'a_alat' => 'boolean',
            'a_angkutan' => 'boolean',
            'spm_qty_min_per_siswa' => 'decimal',
            'spm_qty_min_per_sekolah' => 'decimal',
        ];
    }

    /**
     * ref.jenis_sarana ← ref.pemakai_sarana (jenis_sarana_id → jenis_sarana_id).
     */
    public function pemakaiSaranas(): HasMany
    {
        return $this->hasMany(PemakaiSarana::class, 'jenis_sarana_id', 'jenis_sarana_id');
    }

    /**
     * ref.jenis_sarana ← ref.sasaran_blockgrant (jenis_sarana_id → jenis_sarana_id).
     */
    public function sasaranBlockgrants(): HasMany
    {
        return $this->hasMany(SasaranBlockgrant::class, 'jenis_sarana_id', 'jenis_sarana_id');
    }

    /**
     * ref.jenis_sarana ← ref.standar_sarana (jenis_sarana_id → jenis_sarana_id).
     */
    public function standarSaranas(): HasMany
    {
        return $this->hasMany(StandarSarana::class, 'jenis_sarana_id', 'jenis_sarana_id');
    }
}
