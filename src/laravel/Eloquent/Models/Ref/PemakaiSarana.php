<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemakaiSarana extends Pivot
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    public $incrementing = false;

    /**
     * ref.pemakai_sarana → ref.jurusan (jurusan_id → jurusan_id).
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.pemakai_sarana → ref.jenis_sarana (jenis_sarana_id → jenis_sarana_id).
     */
    public function jenisSarana(): BelongsTo
    {
        return $this->belongsTo(JenisSarana::class, 'jenis_sarana_id', 'jenis_sarana_id');
    }
}
