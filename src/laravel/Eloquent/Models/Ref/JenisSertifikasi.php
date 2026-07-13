<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisSertifikasi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_jenis_sertifikasi';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'prof_guru' => 'boolean',
            'kepala_sekolah' => 'boolean',
            'laboran' => 'boolean',
            'a_pd' => 'boolean',
        ];
    }

    /**
     * ref.jenis_sertifikasi → ref.kebutuhan_khusus (kebutuhan_khusus_id → kebutuhan_khusus_id).
     */
    public function kebutuhanKhusus(): BelongsTo
    {
        return $this->belongsTo(KebutuhanKhusus::class, 'kebutuhan_khusus_id', 'kebutuhan_khusus_id');
    }
}
