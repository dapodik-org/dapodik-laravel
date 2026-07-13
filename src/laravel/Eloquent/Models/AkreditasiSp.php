<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkreditasiSp extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'akred_sp_id';

    protected function casts(): array
    {
        return [
            'akred_sp_tmt' => 'date',
            'akred_sp_tst' => 'date',
            'akreditasi_id' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.akreditasi_sp → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }
}
