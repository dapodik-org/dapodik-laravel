<?php

namespace Dapodik\Laravel\Eloquent\Models\ManAkses;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePengguna extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_role_pengguna';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * man_akses.role_pengguna → man_akses.peran (peran_id → peran_id).
     */
    public function peran(): BelongsTo
    {
        return $this->belongsTo(Peran::class, 'peran_id', 'peran_id');
    }

    /**
     * man_akses.role_pengguna ← man_akses.log_otorisasi (id_role_pengguna → id_role_pengguna).
     */
    public function logOtorisasis(): HasMany
    {
        return $this->hasMany(LogOtorisasi::class, 'id_role_pengguna', 'id_role_pengguna');
    }
}
