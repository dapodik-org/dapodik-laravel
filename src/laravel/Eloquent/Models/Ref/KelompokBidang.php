<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelompokBidang extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'level_bidang_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'untuk_sma' => 'boolean',
            'untuk_smk' => 'boolean',
            'untuk_pt' => 'boolean',
            'untuk_slb' => 'boolean',
            'untuk_smklb' => 'boolean',
        ];
    }

    /**
     * ref.kelompok_bidang ← ref.jurusan (level_bidang_id → level_bidang_id).
     */
    public function jurusans(): HasMany
    {
        return $this->hasMany(Jurusan::class, 'level_bidang_id', 'level_bidang_id');
    }

    /**
     * ref.kelompok_bidang → ref.kelompok_bidang (level_bidang_induk → level_bidang_id).
     */
    public function levelBidangInduk(): BelongsTo
    {
        return $this->belongsTo(self::class, 'level_bidang_induk', 'level_bidang_id');
    }

    /**
     * ref.kelompok_bidang ← ref.jurusan (level_bidang_id → level_bidang_id).
     */

    /**
     * ref.kelompok_bidang ← ref.kelompok_bidang (level_bidang_id → level_bidang_induk).
     */
    public function kelompokBidangs(): HasMany
    {
        return $this->hasMany(self::class, 'level_bidang_induk', 'level_bidang_id');
    }
}
