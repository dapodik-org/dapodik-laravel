<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JabatanPtk extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jabatan_ptk_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.jabatan_ptk → ref.jenis_ptk (jenis_ptk_id → jenis_ptk_id).
     */
    public function jenisPtk(): BelongsTo
    {
        return $this->belongsTo(JenisPtk::class, 'jenis_ptk_id', 'jenis_ptk_id');
    }
}
