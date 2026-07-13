<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BidangStudi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'bidang_studi_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'kelompok' => 'boolean',
            'jenjang_paud' => 'boolean',
            'jenjang_tk' => 'boolean',
            'jenjang_sd' => 'boolean',
            'jenjang_smp' => 'boolean',
            'jenjang_sma' => 'boolean',
            'jenjang_tinggi' => 'boolean',
            'a_sert_komp' => 'boolean',
            'a_sert_profesi' => 'boolean',
        ];
    }

    /**
     * ref.bidang_studi ← ref.map_bidang_mata_pelajaran (bidang_studi_id → bidang_studi_id).
     */
    public function mapBidangMataPelajarans(): HasMany
    {
        return $this->hasMany(MapBidangMataPelajaran::class, 'bidang_studi_id', 'bidang_studi_id');
    }

    /**
     * ref.bidang_studi → ref.bidang_studi (kelompok_bidang_studi_id → bidang_studi_id).
     */
    public function kelompokBidangStudi(): BelongsTo
    {
        return $this->belongsTo(self::class, 'kelompok_bidang_studi_id', 'bidang_studi_id');
    }

    /**
     * ref.bidang_studi ← ref.bidang_studi (bidang_studi_id → kelompok_bidang_studi_id).
     */
    public function bidangStudis(): HasMany
    {
        return $this->hasMany(self::class, 'kelompok_bidang_studi_id', 'bidang_studi_id');
    }

    /*
     * ref.bidang_studi ← ref.map_bidang_mata_pelajaran (bidang_studi_id → bidang_studi_id)
     */
}
