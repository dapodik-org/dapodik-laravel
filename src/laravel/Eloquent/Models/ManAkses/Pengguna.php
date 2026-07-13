<?php

namespace Dapodik\Laravel\Eloquent\Models\ManAkses;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengguna extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'pengguna_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * man_akses.pengguna ← man_akses.log_otentikasi (pengguna_id → pengguna_id).
     */
    public function logOtentikasis(): HasMany
    {
        return $this->hasMany(LogOtentikasi::class, 'pengguna_id', 'pengguna_id');
    }
}
