<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JurusanKerjasama extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['mou_id', 'jurusan_sp_id'];

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.jurusan_kerjasama → public.jurusan_sp (jurusan_sp_id → jurusan_sp_id).
     */
    public function jurusanSp(): BelongsTo
    {
        return $this->belongsTo(JurusanSp::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.jurusan_kerjasama → public.mou (mou_id → mou_id).
     */
    public function mou(): BelongsTo
    {
        return $this->belongsTo(Mou::class, 'mou_id', 'mou_id');
    }
}
