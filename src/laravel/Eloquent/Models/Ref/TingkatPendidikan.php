<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TingkatPendidikan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'tingkat_pendidikan_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.tingkat_pendidikan → ref.jenjang_pendidikan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function jenjangPendidikan(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }

    /**
     * ref.tingkat_pendidikan ← ref.group_matpel (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */
    public function groupMatpels(): HasMany
    {
        return $this->hasMany(GroupMatpel::class, 'tingkat_pendidikan_id', 'tingkat_pendidikan_id');
    }

    /**
     * ref.tingkat_pendidikan ← ref.kompetensi (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */
    public function kompetensis(): HasMany
    {
        return $this->hasMany(Kompetensi::class, 'tingkat_pendidikan_id', 'tingkat_pendidikan_id');
    }

    /**
     * ref.tingkat_pendidikan ← ref.mata_pelajaran_kurikulum (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */
    public function mataPelajaranKurikulums(): HasMany
    {
        return $this->hasMany(MataPelajaranKurikulum::class, 'tingkat_pendidikan_id', 'tingkat_pendidikan_id');
    }
}
