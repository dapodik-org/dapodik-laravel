<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_buku';

    protected function casts(): array
    {
        return [
            'tgl_hapus_buku' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.buku → public.ruang (id_ruang → id_ruang).
     */
    public function ruang(): BelongsTo
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.buku → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.buku ← public.buku_longitudinal (id_buku → id_buku).
     */
    public function bukuLongitudinals(): HasMany
    {
        return $this->hasMany(BukuLongitudinal::class, 'id_buku', 'id_buku');
    }
}
