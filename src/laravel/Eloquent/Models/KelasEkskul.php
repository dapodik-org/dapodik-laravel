<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\EkstraKurikuler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasEkskul extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_kelas_ekskul';

    protected function casts(): array
    {
        return [
            'id_ekskul' => 'integer',
            'tgl_sk_ekskul' => 'date',
            'jam_kegiatan_per_minggu' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.kelas_ekskul → public.rombongan_belajar (rombongan_belajar_id → rombongan_belajar_id).
     */
    public function rombonganBelajar(): BelongsTo
    {
        return $this->belongsTo(RombonganBelajar::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    /**
     * public.kelas_ekskul → ref.ekstra_kurikuler (id_ekskul → id_ekskul).
     */
    public function ekskul(): BelongsTo
    {
        return $this->belongsTo(EkstraKurikuler::class, 'id_ekskul', 'id_ekskul');
    }
}
