<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemakaiPrasarana extends Pivot
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    public $incrementing = false;

    /**
     * ref.pemakai_prasarana → ref.jenis_prasarana (jenis_prasarana_id → jenis_prasarana_id).
     */
    public function jenisPrasarana(): BelongsTo
    {
        return $this->belongsTo(JenisPrasarana::class, 'jenis_prasarana_id', 'jenis_prasarana_id');
    }

    /**
     * ref.pemakai_prasarana → ref.jurusan (jurusan_id → jurusan_id).
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }
}
