<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jurusan_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'untuk_sma' => 'boolean',
            'untuk_smk' => 'boolean',
            'untuk_pt' => 'boolean',
            'untuk_slb' => 'boolean',
            'untuk_smklb' => 'boolean',
        ];
    }

    /**
     * ref.jurusan → ref.jenjang_pendidikan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function jenjangPendidikan(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }

    /**
     * ref.jurusan → ref.kelompok_bidang (level_bidang_id → level_bidang_id).
     */
    public function levelBidang(): BelongsTo
    {
        return $this->belongsTo(KelompokBidang::class, 'level_bidang_id', 'level_bidang_id');
    }

    /**
     * ref.jurusan ← ref.kurikulum (jurusan_id → jurusan_id).
     */
    public function kurikulums(): HasMany
    {
        return $this->hasMany(Kurikulum::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.jurusan ← ref.mata_pelajaran (jurusan_id → jurusan_id).
     */
    public function mataPelajarans(): HasMany
    {
        return $this->hasMany(MataPelajaran::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.jurusan ← ref.pemakai_prasarana (jurusan_id → jurusan_id).
     */
    public function pemakaiPrasaranas(): HasMany
    {
        return $this->hasMany(PemakaiPrasarana::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.jurusan ← ref.pemakai_sarana (jurusan_id → jurusan_id).
     */
    public function pemakaiSaranas(): HasMany
    {
        return $this->hasMany(PemakaiSarana::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.jurusan ← ref.standar_sarana (jurusan_id → jurusan_id).
     */
    public function standarSaranas(): HasMany
    {
        return $this->hasMany(StandarSarana::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.jurusan ← ref.template_un (jurusan_id → jurusan_id).
     */
    public function templateUns(): HasMany
    {
        return $this->hasMany(TemplateUn::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.jurusan → ref.jenjang_pendidikan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */

    /**
     * ref.jurusan → ref.jurusan (jurusan_induk → jurusan_id).
     */
    public function jurusanInduk(): BelongsTo
    {
        return $this->belongsTo(self::class, 'jurusan_induk', 'jurusan_id');
    }

    /**
     * ref.jurusan → ref.kelompok_bidang (level_bidang_id → level_bidang_id).
     */

    /**
     * ref.jurusan ← ref.jurusan (jurusan_id → jurusan_induk).
     */
    public function jurusans(): HasMany
    {
        return $this->hasMany(self::class, 'jurusan_induk', 'jurusan_id');
    }

    /*
     * ref.jurusan ← ref.kurikulum (jurusan_id → jurusan_id)
     */

    /*
     * ref.jurusan ← ref.mata_pelajaran (jurusan_id → jurusan_id)
     */

    /*
     * ref.jurusan ← ref.pemakai_prasarana (jurusan_id → jurusan_id)
     */

    /*
     * ref.jurusan ← ref.pemakai_sarana (jurusan_id → jurusan_id)
     */

    /*
     * ref.jurusan ← ref.standar_sarana (jurusan_id → jurusan_id)
     */

    /*
     * ref.jurusan ← ref.template_un (jurusan_id → jurusan_id)
     */
}
