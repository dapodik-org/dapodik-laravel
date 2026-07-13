<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SasaranBlockgrant extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'sasaran_blockgrant_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.sasaran_blockgrant → ref.jenis_bantuan (jenis_bantuan_id → jenis_bantuan_id).
     */
    public function jenisBantuan(): BelongsTo
    {
        return $this->belongsTo(JenisBantuan::class, 'jenis_bantuan_id', 'jenis_bantuan_id');
    }

    /**
     * ref.sasaran_blockgrant → ref.jenis_prasarana (jenis_prasarana_id → jenis_prasarana_id).
     */
    public function jenisPrasarana(): BelongsTo
    {
        return $this->belongsTo(JenisPrasarana::class, 'jenis_prasarana_id', 'jenis_prasarana_id');
    }

    /**
     * ref.sasaran_blockgrant → ref.jenis_sarana (jenis_sarana_id → jenis_sarana_id).
     */
    public function jenisSarana(): BelongsTo
    {
        return $this->belongsTo(JenisSarana::class, 'jenis_sarana_id', 'jenis_sarana_id');
    }

    /**
     * ref.sasaran_blockgrant → ref.sumber_dana (sumber_dana_id → sumber_dana_id).
     */
    public function sumberDana(): BelongsTo
    {
        return $this->belongsTo(SumberDana::class, 'sumber_dana_id', 'sumber_dana_id');
    }

    /**
     * ref.sasaran_blockgrant → ref.tahun_ajaran (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }
}
