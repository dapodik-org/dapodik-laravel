<?php

namespace Dapodik\Laravel\Eloquent\Models\ManAkses;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_menu';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * man_akses.menu → man_akses.aplikasi (id_aplikasi → id_aplikasi).
     */
    public function aplikasi(): BelongsTo
    {
        return $this->belongsTo(Aplikasi::class, 'id_aplikasi', 'id_aplikasi');
    }

    /**
     * man_akses.menu ← man_akses.menu_role (id_menu → id_menu).
     */
    public function menuRoles(): HasMany
    {
        return $this->hasMany(MenuRole::class, 'id_menu', 'id_menu');
    }

    /**
     * man_akses.menu → man_akses.aplikasi (id_aplikasi → id_aplikasi).
     */

    /**
     * man_akses.menu → man_akses.menu (men_id_menu → id_menu).
     */
    public function idMenu(): BelongsTo
    {
        return $this->belongsTo(self::class, 'men_id_menu', 'id_menu');
    }

    /**
     * man_akses.menu ← man_akses.menu (id_menu → men_id_menu).
     */
    public function menus(): HasMany
    {
        return $this->hasMany(self::class, 'men_id_menu', 'id_menu');
    }

    /*
     * man_akses.menu ← man_akses.menu_role (id_menu → id_menu)
     */
}
