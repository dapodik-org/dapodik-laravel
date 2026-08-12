<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPrestasi;
use Dapodik\Laravel\Eloquent\Models\Ref\TingkatPrestasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestasi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'prestasi_id';

    protected function casts(): array
    {
        return [
            'tahun_prestasi' => 'decimal',
            'peringkat' => 'integer',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.prestasi → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.prestasi ← public.vld_prestasi (prestasi_id → prestasi_id).
     */
    public function vldPrestasis(): HasMany
    {
        return $this->hasMany(VldPrestasi::class, 'prestasi_id', 'prestasi_id');
    }

    /**
     * public.prestasi → ref.jenis_prestasi (jenis_prestasi_id → jenis_prestasi_id).
     */
    public function jenisPrestasi(): BelongsTo
    {
        return $this->belongsTo(JenisPrestasi::class, 'jenis_prestasi_id', 'jenis_prestasi_id');
    }

    /**
     * public.prestasi → ref.tingkat_prestasi (tingkat_prestasi_id → tingkat_prestasi_id).
     */
    public function tingkatPrestasi(): BelongsTo
    {
        return $this->belongsTo(TingkatPrestasi::class, 'tingkat_prestasi_id', 'tingkat_prestasi_id');
    }
}
