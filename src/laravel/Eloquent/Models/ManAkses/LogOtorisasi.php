<?php

namespace Dapodik\Laravel\Eloquent\Models\ManAkses;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogOtorisasi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'token_sesi';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * man_akses.log_otorisasi → man_akses.role_pengguna (id_role_pengguna → id_role_pengguna).
     */
    public function rolePengguna(): BelongsTo
    {
        return $this->belongsTo(RolePengguna::class, 'id_role_pengguna', 'id_role_pengguna');
    }
}
