<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPenghargaan;
use Dapodik\Laravel\Eloquent\Models\Ref\TingkatPenghargaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penghargaan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'penghargaan_id';

    protected function casts(): array
    {
        return [
            'tahun' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.penghargaan → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.penghargaan ← public.vld_penghargaan (penghargaan_id → penghargaan_id).
     */
    public function vldPenghargaans(): HasMany
    {
        return $this->hasMany(VldPenghargaan::class, 'penghargaan_id', 'penghargaan_id');
    }

    /**
     * public.penghargaan → ref.jenis_penghargaan (jenis_penghargaan_id → jenis_penghargaan_id).
     */
    public function jenisPenghargaan(): BelongsTo
    {
        return $this->belongsTo(JenisPenghargaan::class, 'jenis_penghargaan_id', 'jenis_penghargaan_id');
    }

    /**
     * public.penghargaan → ref.tingkat_penghargaan (tingkat_penghargaan_id → tingkat_penghargaan_id).
     */
    public function tingkatPenghargaan(): BelongsTo
    {
        return $this->belongsTo(TingkatPenghargaan::class, 'tingkat_penghargaan_id', 'tingkat_penghargaan_id');
    }
}
