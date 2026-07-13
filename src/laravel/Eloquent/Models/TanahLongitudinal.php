<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TanahLongitudinal extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['id_tanah', 'tahun_ajaran_id'];

    protected function casts(): array
    {
        return [
            'njop' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.tanah_longitudinal → public.tanah (id_tanah → id_tanah).
     */
    public function tanah(): BelongsTo
    {
        return $this->belongsTo(Tanah::class, 'id_tanah', 'id_tanah');
    }
}
