<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangUsaha;
use Dapodik\Laravel\Eloquent\Models\Ref\Pekerjaan;
use Dapodik\Laravel\Eloquent\Models\Ref\Penghasilan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TracerLulusan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_tracer';

    protected function casts(): array
    {
        return [
            'tgl_entry' => 'date',
            'a_sesuai_kompetensi' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.tracer_lulusan → public.dudi (dudi_id → dudi_id).
     */
    public function dudi(): BelongsTo
    {
        return $this->belongsTo(Dudi::class, 'dudi_id', 'dudi_id');
    }

    /**
     * public.tracer_lulusan → public.registrasi_peserta_didik (registrasi_id → registrasi_id).
     */
    public function registrasi(): BelongsTo
    {
        return $this->belongsTo(RegistrasiPesertaDidik::class, 'registrasi_id', 'registrasi_id');
    }

    /**
     * public.tracer_lulusan → ref.penghasilan (penghasilan_id → penghasilan_id).
     */
    public function penghasilan(): BelongsTo
    {
        return $this->belongsTo(Penghasilan::class, 'penghasilan_id', 'penghasilan_id');
    }

    /**
     * public.tracer_lulusan → ref.bidang_usaha (bidang_usaha_id → bidang_usaha_id).
     */
    public function bidangUsaha(): BelongsTo
    {
        return $this->belongsTo(BidangUsaha::class, 'bidang_usaha_id', 'bidang_usaha_id');
    }

    /**
     * public.tracer_lulusan → ref.pekerjaan (pekerjaan_id → pekerjaan_id).
     */
    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'pekerjaan_id');
    }
}
