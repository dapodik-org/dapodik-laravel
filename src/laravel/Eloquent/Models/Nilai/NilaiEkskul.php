<?php

namespace Dapodik\Laravel\Eloquent\Models\Nilai;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\AnggotaRombel;
use Dapodik\Laravel\Eloquent\Models\KelasEkskul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiEkskul extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'id_nilai_x';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * nilai.nilai_ekskul → public.kelas_ekskul (id_kelas_ekskul → id_kelas_ekskul).
     */
    public function kelasEkskul(): BelongsTo
    {
        return $this->belongsTo(KelasEkskul::class, 'id_kelas_ekskul', 'id_kelas_ekskul');
    }

    /**
     * nilai.nilai_ekskul → public.anggota_rombel (anggota_rombel_id → anggota_rombel_id).
     */
    public function anggotaRombel(): BelongsTo
    {
        return $this->belongsTo(AnggotaRombel::class, 'anggota_rombel_id', 'anggota_rombel_id');
    }
}
