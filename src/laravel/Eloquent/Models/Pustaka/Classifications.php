<?php

namespace Dapodik\Laravel\Eloquent\Models\Pustaka;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classifications extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_classification';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * pustaka.classifications ← pustaka.biblio (id_classification → id_classification).
     */
    public function biblios(): HasMany
    {
        return $this->hasMany(Biblio::class, 'id_classification', 'id_classification');
    }

    /**
     * pustaka.classifications → pustaka.classifications (id_classification_parent → id_classification).
     */
    public function classificationParent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'id_classification_parent', 'id_classification');
    }

    /**
     * pustaka.classifications ← pustaka.classifications (id_classification → id_classification_parent).
     */
    public function classifications(): HasMany
    {
        return $this->hasMany(self::class, 'id_classification_parent', 'id_classification');
    }
}
