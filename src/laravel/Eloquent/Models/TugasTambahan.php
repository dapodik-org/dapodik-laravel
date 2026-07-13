<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TugasTambahan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'ptk_tugas_tambahan_id';

    protected function casts(): array
    {
        return [
            'jumlah_jam' => 'decimal',
            'tmt_tambahan' => 'date',
            'tst_tambahan' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.tugas_tambahan → public.ruang (id_ruang → id_ruang).
     */
    public function ruang(): BelongsTo
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.tugas_tambahan → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.tugas_tambahan → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.tugas_tambahan ← public.vld_tugas_tambahan (ptk_tugas_tambahan_id → ptk_tugas_tambahan_id).
     */
    public function vldTugasTambahans(): HasMany
    {
        return $this->hasMany(VldTugasTambahan::class, 'ptk_tugas_tambahan_id', 'ptk_tugas_tambahan_id');
    }
}
