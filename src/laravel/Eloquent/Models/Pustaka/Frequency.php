<?php

namespace Dapodik\Laravel\Eloquent\Models\Pustaka;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frequency extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_freq';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * pustaka.frequency ← pustaka.biblio (id_freq → id_freq).
     */
    public function biblios(): HasMany
    {
        return $this->hasMany(Biblio::class, 'id_freq', 'id_freq');
    }
}
