<?php

namespace Dapodik\Laravel\Eloquent\Models\Nilai;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiRapor extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'nilai_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * nilai.nilai_rapor → nilai.matev_rapor (id_evaluasi → id_evaluasi).
     */
    public function evaluasi(): BelongsTo
    {
        return $this->belongsTo(MatevRapor::class, 'id_evaluasi', 'id_evaluasi');
    }
}
