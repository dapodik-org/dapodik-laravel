<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instalasi extends Model
{
    use HasConnection;
    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_instalasi';

    protected function casts(): array
    {
        return [
            'a_link_aktif' => 'decimal',
        ];
    }

    /**
     * public.instalasi → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.instalasi ← public.sync_log (id_instalasi → id_instalasi).
     */
    public function syncLogs(): HasMany
    {
        return $this->hasMany(SyncLog::class, 'id_instalasi', 'id_instalasi');
    }

    /**
     * public.instalasi ← public.sync_session (id_instalasi → id_instalasi).
     */
    public function syncSessions(): HasMany
    {
        return $this->hasMany(SyncSession::class, 'id_instalasi', 'id_instalasi');
    }

    /**
     * public.instalasi ← public.table_sync_log (id_instalasi → id_instalasi).
     */
    public function tableSyncLogs(): HasMany
    {
        return $this->hasMany(TableSyncLog::class, 'id_instalasi', 'id_instalasi');
    }
}
