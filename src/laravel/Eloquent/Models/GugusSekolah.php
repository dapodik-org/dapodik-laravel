<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GugusSekolah extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'gugus_id';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.gugus_sekolah → public.sekolah (sekolah_inti_id → sekolah_id).
     */
    public function sekolahInti(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_inti_id', 'sekolah_id');
    }

    /**
     * public.gugus_sekolah ← public.anggota_gugus (gugus_id → gugus_id).
     */
    public function anggotaGuguses(): HasMany
    {
        return $this->hasMany(AnggotaGugus::class, 'gugus_id', 'gugus_id');
    }
}
