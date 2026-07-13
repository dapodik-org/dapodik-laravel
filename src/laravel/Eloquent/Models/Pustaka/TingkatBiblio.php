<?php

namespace Dapodik\Laravel\Eloquent\Models\Pustaka;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TingkatBiblio extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = ['id_biblio', 'tingkat_pendidikan_id', 'bentuk_pendidikan_id'];

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * pustaka.tingkat_biblio → pustaka.biblio (id_biblio → id_biblio).
     */
    public function biblio(): BelongsTo
    {
        return $this->belongsTo(Biblio::class, 'id_biblio', 'id_biblio');
    }
}
