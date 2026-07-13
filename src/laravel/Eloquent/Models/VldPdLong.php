<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VldPdLong extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'logid';

    protected function casts(): array
    {
        return [
            'idtype' => 'integer',
            'status_validasi' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.vld_pd_long → public.peserta_didik_longitudinal (peserta_didik_id → semester_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidikLongitudinal::class, 'peserta_didik_id', 'semester_id');
    }

    /**
     * public.vld_pd_long → public.peserta_didik_longitudinal (semester_id → semester_id).
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(PesertaDidikLongitudinal::class, 'semester_id', 'semester_id');
    }
}
