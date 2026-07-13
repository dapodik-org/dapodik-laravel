<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatasWaktuRapor extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'semester_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'tgl_rapor_mulai' => 'date',
            'tgl_rapor_selesai' => 'date',
            'tgl_usm_mulai' => 'date',
            'tgl_usm_selesai' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.batas_waktu_rapor → ref.semester (semester_id → semester_id).
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }
}
