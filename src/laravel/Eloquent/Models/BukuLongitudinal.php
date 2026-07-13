<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuLongitudinal extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['id_buku', 'semester_id'];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'status_kelaikan' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.buku_longitudinal → public.buku (id_buku → id_buku).
     */
    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }
}
