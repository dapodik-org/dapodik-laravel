<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuPelajaran extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_biblio';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.buku_pelajaran → public.pembelajaran (pembelajaran_id → pembelajaran_id).
     */
    public function pembelajaran(): BelongsTo
    {
        return $this->belongsTo(Pembelajaran::class, 'pembelajaran_id', 'pembelajaran_id');
    }
}
