<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataPelajaran extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'mata_pelajaran_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'pilihan_sekolah' => 'boolean',
            'pilihan_buku' => 'boolean',
            'pilihan_kepengawasan' => 'boolean',
            'pilihan_evaluasi' => 'boolean',
        ];
    }

    /**
     * ref.mata_pelajaran → ref.jurusan (jurusan_id → jurusan_id).
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.mata_pelajaran ← ref.kompetensi (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function kompetensis(): HasMany
    {
        return $this->hasMany(Kompetensi::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * ref.mata_pelajaran ← ref.map_bidang_mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mapBidangMataPelajarans(): HasMany
    {
        return $this->hasMany(MapBidangMataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * ref.mata_pelajaran ← ref.mata_pelajaran_kurikulum (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mataPelajaranKurikulums(): HasMany
    {
        return $this->hasMany(MataPelajaranKurikulum::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * ref.mata_pelajaran ← ref.mulok (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function muloks(): HasMany
    {
        return $this->hasMany(Mulok::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * ref.mata_pelajaran ← ref.template_rapor (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function templateRapors(): HasMany
    {
        return $this->hasMany(TemplateRapor::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * ref.mata_pelajaran ← ref.template_un (mata_pelajaran_id → mp6_id).
     */
    public function templateUns(): HasMany
    {
        return $this->hasMany(TemplateUn::class, 'mp6_id', 'mata_pelajaran_id');
    }
}
