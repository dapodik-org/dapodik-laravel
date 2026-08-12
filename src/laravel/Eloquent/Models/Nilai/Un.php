<?php

namespace Dapodik\Laravel\Eloquent\Models\Nilai;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\TahunAjaran;
use Dapodik\Laravel\Eloquent\Models\Ref\TemplateUn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Un extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'un_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * nilai.un → ref.template_un (template_id → template_id).
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(TemplateUn::class, 'template_id', 'template_id');
    }

    /**
     * nilai.un → ref.tahun_ajaran (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }
}
