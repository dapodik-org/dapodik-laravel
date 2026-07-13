<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisBeasiswa extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jenis_beasiswa_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'untuk_pd' => 'boolean',
            'untuk_ptk' => 'boolean',
        ];
    }

    /**
     * ref.jenis_beasiswa → ref.sumber_dana (sumber_dana_id → sumber_dana_id).
     */
    public function sumberDana(): BelongsTo
    {
        return $this->belongsTo(SumberDana::class, 'sumber_dana_id', 'sumber_dana_id');
    }
}
