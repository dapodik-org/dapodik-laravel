<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusDiKurikulum extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'status_di_kurikulum';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.status_di_kurikulum ← ref.mata_pelajaran_kurikulum (status_di_kurikulum → status_di_kurikulum).
     */
    public function mataPelajaranKurikulums(): HasMany
    {
        return $this->hasMany(MataPelajaranKurikulum::class, 'status_di_kurikulum', 'status_di_kurikulum');
    }
}
