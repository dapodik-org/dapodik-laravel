<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Yayasan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'yayasan_id';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'rt' => 'decimal',
            'rw' => 'decimal',
            'lintang' => 'decimal',
            'bujur' => 'decimal',
            'tanggal_pendirian_yayasan' => 'date',
            'tanggal_sk_bn' => 'date',
        ];
    }

    /**
     * public.yayasan ← public.sekolah (yayasan_id → yayasan_id).
     */
    public function sekolahs(): HasMany
    {
        return $this->hasMany(Sekolah::class, 'yayasan_id', 'yayasan_id');
    }

    /**
     * public.yayasan ← public.vld_yayasan (yayasan_id → yayasan_id).
     */
    public function vldYayasans(): HasMany
    {
        return $this->hasMany(VldYayasan::class, 'yayasan_id', 'yayasan_id');
    }
}
