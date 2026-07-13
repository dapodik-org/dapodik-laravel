<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BantuanPd extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_bantuan_pd';

    protected function casts(): array
    {
        return [
            'besar_bantuan' => 'decimal',
            'dana_pendamping' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.bantuan_pd → public.anggota_rombel (anggota_rombel_id → anggota_rombel_id).
     */
    public function anggotaRombel(): BelongsTo
    {
        return $this->belongsTo(AnggotaRombel::class, 'anggota_rombel_id', 'anggota_rombel_id');
    }
}
