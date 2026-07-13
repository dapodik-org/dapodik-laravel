<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KebutuhanKhusus extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'kebutuhan_khusus_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'kk_a' => 'boolean',
            'kk_b' => 'boolean',
            'kk_c' => 'boolean',
            'kk_c1' => 'boolean',
            'kk_d' => 'boolean',
            'kk_d1' => 'boolean',
            'kk_e' => 'boolean',
            'kk_f' => 'boolean',
            'kk_h' => 'boolean',
            'kk_i' => 'boolean',
            'kk_j' => 'boolean',
            'kk_k' => 'boolean',
            'kk_n' => 'boolean',
            'kk_o' => 'boolean',
            'kk_p' => 'boolean',
            'kk_q' => 'boolean',
            'untuk_lembaga' => 'boolean',
            'untuk_ptk' => 'boolean',
            'untuk_pd' => 'boolean',
        ];
    }

    /**
     * ref.kebutuhan_khusus ← ref.jenis_sertifikasi (kebutuhan_khusus_id → kebutuhan_khusus_id).
     */
    public function jenisSertifikasis(): HasMany
    {
        return $this->hasMany(JenisSertifikasi::class, 'kebutuhan_khusus_id', 'kebutuhan_khusus_id');
    }
}
