<?php

namespace Dapodik\Laravel\Eloquent\Models\ManAkses;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aplikasi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_aplikasi';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * man_akses.aplikasi ← man_akses.menu (id_aplikasi → id_aplikasi).
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'id_aplikasi', 'id_aplikasi');
    }
}
