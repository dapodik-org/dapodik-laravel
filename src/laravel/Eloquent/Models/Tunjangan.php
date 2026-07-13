<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tunjangan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'tunjangan_id';

    protected function casts(): array
    {
        return [
            'tgl_sk_tunjangan' => 'date',
            'dari_tahun' => 'decimal',
            'sampai_tahun' => 'decimal',
            'nominal' => 'decimal',
            'status' => 'integer',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.tunjangan → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.tunjangan ← public.vld_tunjangan (tunjangan_id → tunjangan_id).
     */
    public function vldTunjangans(): HasMany
    {
        return $this->hasMany(VldTunjangan::class, 'tunjangan_id', 'tunjangan_id');
    }
}
