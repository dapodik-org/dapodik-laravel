<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateUn extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'template_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.template_un → ref.jenjang_pendidikan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function jenjangPendidikan(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }

    /**
     * ref.template_un → ref.jurusan (jurusan_id → jurusan_id).
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }

    /**
     * ref.template_un → ref.mata_pelajaran (mp3_id → mata_pelajaran_id).
     */
    public function mp3(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mp3_id', 'mata_pelajaran_id');
    }

    /**
     * ref.template_un → ref.mata_pelajaran (mp4_id → mata_pelajaran_id).
     */
    public function mp4(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mp4_id', 'mata_pelajaran_id');
    }

    /**
     * ref.template_un → ref.mata_pelajaran (mp7_id → mata_pelajaran_id).
     */
    public function mp7(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mp7_id', 'mata_pelajaran_id');
    }

    /**
     * ref.template_un → ref.mata_pelajaran (mp5_id → mata_pelajaran_id).
     */
    public function mp5(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mp5_id', 'mata_pelajaran_id');
    }

    /**
     * ref.template_un → ref.mata_pelajaran (mp1_id → mata_pelajaran_id).
     */
    public function mp1(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mp1_id', 'mata_pelajaran_id');
    }

    /**
     * ref.template_un → ref.mata_pelajaran (mp2_id → mata_pelajaran_id).
     */
    public function mp2(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mp2_id', 'mata_pelajaran_id');
    }

    /**
     * ref.template_un → ref.mata_pelajaran (mp6_id → mata_pelajaran_id).
     */
    public function mp6(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mp6_id', 'mata_pelajaran_id');
    }

    /**
     * ref.template_un → ref.tahun_ajaran (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    /**
     * ref.template_un ← ref.template_rapor (template_id → template_id).
     */
    public function templateRapors(): HasMany
    {
        return $this->hasMany(TemplateRapor::class, 'template_id', 'template_id');
    }
}
