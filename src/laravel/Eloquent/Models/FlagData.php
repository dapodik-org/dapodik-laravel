<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisFlag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlagData extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'flag_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'soft_delete' => 'boolean',
            'last_sync' => 'datetime',
            'value_date' => 'date',
            'value_int' => 'integer',
            'value_double' => 'decimal',
            'mulai_dari' => 'date',
            'berlaku_sampai' => 'date',
        ];
    }

    /**
     * public.flag_data → ref.jenis_flag (jenis_flag_id → jenis_flag_id).
     */
    public function jenisFlag(): BelongsTo
    {
        return $this->belongsTo(JenisFlag::class, 'jenis_flag_id', 'jenis_flag_id');
    }

    /**
     * public.flag_data → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.flag_data → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.flag_data → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }
}
