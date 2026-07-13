<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SumberDana extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'sumber_dana_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.sumber_dana ← ref.jenis_beasiswa (sumber_dana_id → sumber_dana_id).
     */
    public function jenisBeasiswas(): HasMany
    {
        return $this->hasMany(JenisBeasiswa::class, 'sumber_dana_id', 'sumber_dana_id');
    }

    /**
     * ref.sumber_dana ← ref.sasaran_blockgrant (sumber_dana_id → sumber_dana_id).
     */
    public function sasaranBlockgrants(): HasMany
    {
        return $this->hasMany(SasaranBlockgrant::class, 'sumber_dana_id', 'sumber_dana_id');
    }
}
