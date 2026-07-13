<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenjangPendidikan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jenjang_pendidikan_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'jenjang_lembaga' => 'boolean',
            'jenjang_orang' => 'boolean',
        ];
    }

    /**
     * ref.jenjang_pendidikan ← ref.jurusan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function jurusans(): HasMany
    {
        return $this->hasMany(Jurusan::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }

    /**
     * ref.jenjang_pendidikan ← ref.kurikulum (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function kurikulums(): HasMany
    {
        return $this->hasMany(Kurikulum::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }

    /**
     * ref.jenjang_pendidikan ← ref.template_un (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function templateUns(): HasMany
    {
        return $this->hasMany(TemplateUn::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }

    /**
     * ref.jenjang_pendidikan ← ref.tingkat_pendidikan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function tingkatPendidikans(): HasMany
    {
        return $this->hasMany(TingkatPendidikan::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }
}
