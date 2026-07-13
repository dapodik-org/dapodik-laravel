<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BangunanLongitudinal extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['id_bangunan', 'semester_id'];

    protected function casts(): array
    {
        return [
            'nilai_kerusakan' => 'decimal',
            'rusak_pondasi' => 'decimal',
            'rusak_sloop_kolom_balok' => 'decimal',
            'rusak_plester_struktur' => 'decimal',
            'rusak_kudakuda_atap' => 'decimal',
            'rusak_kaso_atap' => 'decimal',
            'rusak_reng_atap' => 'decimal',
            'rusak_tutup_atap' => 'decimal',
            'nilai_saat_ini' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.bangunan_longitudinal → public.bangunan (id_bangunan → id_bangunan).
     */
    public function bangunan(): BelongsTo
    {
        return $this->belongsTo(Bangunan::class, 'id_bangunan', 'id_bangunan');
    }
}
