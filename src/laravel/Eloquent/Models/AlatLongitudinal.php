<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlatLongitudinal extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['id_alat', 'semester_id'];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'jumlah_laik' => 'integer',
            'status_kelaikan' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.alat_longitudinal → public.alat (id_alat → id_alat).
     */
    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'id_alat', 'id_alat');
    }
}
