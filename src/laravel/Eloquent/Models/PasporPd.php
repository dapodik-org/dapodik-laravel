<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasporPd extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'no_paspor';

    protected function casts(): array
    {
        return [
            'tmt_paspor' => 'date',
            'tst_paspor' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.paspor_pd → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }
}
