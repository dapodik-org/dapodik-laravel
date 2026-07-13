<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'semester_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'semester' => 'decimal',
            'periode_aktif' => 'boolean',
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    /**
     * ref.semester → ref.tahun_ajaran (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    /**
     * ref.semester ← ref.batas_waktu_rapor (semester_id → semester_id).
     */
    public function batasWaktuRapors(): HasMany
    {
        return $this->hasMany(BatasWaktuRapor::class, 'semester_id', 'semester_id');
    }
}
