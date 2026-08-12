<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisAktivitasKepanitiaan;
use Dapodik\Laravel\Eloquent\Models\Ref\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AktivitasKepanitiaan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_akt_pan';

    protected function casts(): array
    {
        return [
            'id_jns_akt_pan' => 'decimal',
            'frek_akt_pan' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.aktivitas_kepanitiaan → public.kepanitiaan (id_panitia → id_panitia).
     */
    public function panitia(): BelongsTo
    {
        return $this->belongsTo(Kepanitiaan::class, 'id_panitia', 'id_panitia');
    }

    /**
     * public.aktivitas_kepanitiaan → ref.jenis_aktivitas_kepanitiaan (id_jns_akt_pan → id_jns_akt_pan).
     */
    public function jnsAktPan(): BelongsTo
    {
        return $this->belongsTo(JenisAktivitasKepanitiaan::class, 'id_jns_akt_pan', 'id_jns_akt_pan');
    }

    /**
     * public.aktivitas_kepanitiaan → ref.semester (semester_id → semester_id).
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }
}
