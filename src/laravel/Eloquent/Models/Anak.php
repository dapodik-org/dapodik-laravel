<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenjangPendidikan;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusAnak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anak extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'anak_id';

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'tahun_masuk' => 'integer',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.anak → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.anak ← public.vld_anak (anak_id → anak_id).
     */
    public function vldAnaks(): HasMany
    {
        return $this->hasMany(VldAnak::class, 'anak_id', 'anak_id');
    }

    /**
     * public.anak → ref.status_anak (status_anak_id → status_anak_id).
     */
    public function statusAnak(): BelongsTo
    {
        return $this->belongsTo(StatusAnak::class, 'status_anak_id', 'status_anak_id');
    }

    /**
     * public.anak → ref.jenjang_pendidikan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function jenjangPendidikan(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }
}
