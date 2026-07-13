<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitUsahaKerjasama extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['mou_id', 'unit_usaha_id'];

    protected function casts(): array
    {
        return [
            'omzet_barang_perbulan' => 'decimal',
            'omzet_jasa_perbulan' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.unit_usaha_kerjasama → public.unit_usaha (unit_usaha_id → unit_usaha_id).
     */
    public function unitUsaha(): BelongsTo
    {
        return $this->belongsTo(UnitUsaha::class, 'unit_usaha_id', 'unit_usaha_id');
    }

    /**
     * public.unit_usaha_kerjasama → public.mou (mou_id → mou_id).
     */
    public function mou(): BelongsTo
    {
        return $this->belongsTo(Mou::class, 'mou_id', 'mou_id');
    }
}
