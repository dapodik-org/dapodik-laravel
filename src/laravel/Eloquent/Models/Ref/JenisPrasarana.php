<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPrasarana extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jenis_prasarana_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'a_unit_organisasi' => 'boolean',
            'a_tanah' => 'boolean',
            'a_bangunan' => 'boolean',
            'a_ruang' => 'boolean',
            'a_sub' => 'boolean',
        ];
    }

    /**
     * ref.jenis_prasarana ← ref.pemakai_prasarana (jenis_prasarana_id → jenis_prasarana_id).
     */
    public function pemakaiPrasaranas(): HasMany
    {
        return $this->hasMany(PemakaiPrasarana::class, 'jenis_prasarana_id', 'jenis_prasarana_id');
    }

    /**
     * ref.jenis_prasarana ← ref.sasaran_blockgrant (jenis_prasarana_id → jenis_prasarana_id).
     */
    public function sasaranBlockgrants(): HasMany
    {
        return $this->hasMany(SasaranBlockgrant::class, 'jenis_prasarana_id', 'jenis_prasarana_id');
    }

    /**
     * ref.jenis_prasarana ← ref.standar_sarana (jenis_prasarana_id → jenis_prasarana_id).
     */
    public function standarSaranas(): HasMany
    {
        return $this->hasMany(StandarSarana::class, 'jenis_prasarana_id', 'jenis_prasarana_id');
    }
}
