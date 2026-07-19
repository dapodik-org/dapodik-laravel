<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisFlag extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jenis_flag_id';

    public $incrementing = false;

    protected $keyType = 'integer';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'untuk_sekolah' => 'boolean',
            'untuk_peserta_didik' => 'boolean',
            'untuk_ptk' => 'boolean',
        ];
    }

    /**
     * ref.jenis_flag ← public.flag_data (jenis_flag_id → jenis_flag_id).
     */
    public function flagDatas(): HasMany
    {
        return $this->hasMany(\Dapodik\Laravel\Eloquent\Models\FlagData::class, 'jenis_flag_id', 'jenis_flag_id');
    }
}
