<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiTest extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'nilai_test_id';

    protected function casts(): array
    {
        return [
            'tahun' => 'decimal',
            'skor' => 'decimal',
            'skor1' => 'decimal',
            'skor2' => 'decimal',
            'skor3' => 'decimal',
            'skor4' => 'decimal',
            'skor5' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.nilai_test → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.nilai_test ← public.vld_nilai_test (nilai_test_id → nilai_test_id).
     */
    public function vldNilaiTests(): HasMany
    {
        return $this->hasMany(VldNilaiTest::class, 'nilai_test_id', 'nilai_test_id');
    }
}
