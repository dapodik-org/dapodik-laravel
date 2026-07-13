<?php

namespace Dapodik\Laravel\Eloquent\Models\ManAkses;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peran extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'peran_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * man_akses.peran ← man_akses.menu_role (peran_id → peran_id).
     */
    public function menuRoles(): HasMany
    {
        return $this->hasMany(MenuRole::class, 'peran_id', 'peran_id');
    }

    /**
     * man_akses.peran ← man_akses.role_pengguna (peran_id → peran_id).
     */
    public function rolePenggunas(): HasMany
    {
        return $this->hasMany(RolePengguna::class, 'peran_id', 'peran_id');
    }
}
