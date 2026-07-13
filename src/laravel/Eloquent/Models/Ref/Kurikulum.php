<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kurikulum extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'kurikulum_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'mulai_berlaku' => 'date',
            'sistem_sks' => 'boolean',
            'total_sks' => 'decimal',
        ];
    }

    /**
     * ref.kurikulum → ref.jurusan (jurusan_id → jurusan_id).
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.kurikulum → ref.jenjang_pendidikan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function jenjangPendidikan(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }

    /**
     * ref.kurikulum ← ref.group_matpel (kurikulum_id → kurikulum_id).
     */
    public function groupMatpels(): HasMany
    {
        return $this->hasMany(GroupMatpel::class, 'kurikulum_id', 'kurikulum_id');
    }

    /**
     * ref.kurikulum ← ref.kompetensi (kurikulum_id → kurikulum_id).
     */
    public function kompetensis(): HasMany
    {
        return $this->hasMany(Kompetensi::class, 'kurikulum_id', 'kurikulum_id');
    }

    /**
     * ref.kurikulum ← ref.mata_pelajaran_kurikulum (kurikulum_id → kurikulum_id).
     */
    public function mataPelajaranKurikulums(): HasMany
    {
        return $this->hasMany(MataPelajaranKurikulum::class, 'kurikulum_id', 'kurikulum_id');
    }
}
