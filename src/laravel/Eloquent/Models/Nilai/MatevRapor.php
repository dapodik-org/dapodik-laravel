<?php

namespace Dapodik\Laravel\Eloquent\Models\Nilai;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatevRapor extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'id_evaluasi';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * nilai.matev_rapor ← nilai.nilai_rapor (id_evaluasi → id_evaluasi).
     */
    public function nilaiRapors(): HasMany
    {
        return $this->hasMany(NilaiRapor::class, 'id_evaluasi', 'id_evaluasi');
    }
}
