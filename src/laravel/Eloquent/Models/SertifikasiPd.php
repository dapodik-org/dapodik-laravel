<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangStudi;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisSertifikasi;
use Dapodik\Laravel\Eloquent\Models\Ref\LembSertifikasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SertifikasiPd extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_sert_pd';

    protected function casts(): array
    {
        return [
            'id_jenis_sertifikasi' => 'decimal',
            'tgl_sert_pd' => 'date',
            'tgl_exp_sert_pd' => 'date',
            'kode_lemb_sert' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.sertifikasi_pd → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.sertifikasi_pd → ref.bidang_studi (bidang_studi_id → bidang_studi_id).
     */
    public function bidangStudi(): BelongsTo
    {
        return $this->belongsTo(BidangStudi::class, 'bidang_studi_id', 'bidang_studi_id');
    }

    /**
     * public.sertifikasi_pd → ref.jenis_sertifikasi (id_jenis_sertifikasi → id_jenis_sertifikasi).
     */
    public function jenisSertifikasi(): BelongsTo
    {
        return $this->belongsTo(JenisSertifikasi::class, 'id_jenis_sertifikasi', 'id_jenis_sertifikasi');
    }

    /**
     * public.sertifikasi_pd → ref.lemb_sertifikasi (kode_lemb_sert → kode_lemb_sert).
     */
    public function kodeLembSert(): BelongsTo
    {
        return $this->belongsTo(LembSertifikasi::class, 'kode_lemb_sert', 'kode_lemb_sert');
    }
}
