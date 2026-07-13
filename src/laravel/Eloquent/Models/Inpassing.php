<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inpassing extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'inpassing_id';

    protected function casts(): array
    {
        return [
            'tgl_sk_inpassing' => 'date',
            'tmt_inpassing' => 'date',
            'angka_kredit' => 'decimal',
            'masa_kerja_tahun' => 'decimal',
            'masa_kerja_bulan' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.inpassing → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.inpassing ← public.vld_inpassing (inpassing_id → inpassing_id).
     */
    public function vldInpassings(): HasMany
    {
        return $this->hasMany(VldInpassing::class, 'inpassing_id', 'inpassing_id');
    }
}
