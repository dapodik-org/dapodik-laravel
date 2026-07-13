<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunAjaran extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'tahun_ajaran_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'periode_aktif' => 'boolean',
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    /**
     * ref.tahun_ajaran ← ref.sasaran_blockgrant (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function sasaranBlockgrants(): HasMany
    {
        return $this->hasMany(SasaranBlockgrant::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    /**
     * ref.tahun_ajaran ← ref.semester (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    /**
     * ref.tahun_ajaran ← ref.template_un (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function templateUns(): HasMany
    {
        return $this->hasMany(TemplateUn::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }
}
