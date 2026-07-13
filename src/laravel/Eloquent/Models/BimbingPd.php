<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BimbingPd extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_bimb_pd';

    protected function casts(): array
    {
        return [
            'urutan_pembimbing' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.bimbing_pd → public.akt_pd (id_akt_pd → id_akt_pd).
     */
    public function aktPd(): BelongsTo
    {
        return $this->belongsTo(AktPd::class, 'id_akt_pd', 'id_akt_pd');
    }

    /**
     * public.bimbing_pd → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }
}
