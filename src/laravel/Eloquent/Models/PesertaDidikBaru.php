<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPendaftaran;
use Dapodik\Laravel\Eloquent\Models\Ref\TahunAjaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesertaDidikBaru extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'pdb_id';

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'sudah_diproses' => 'decimal',
            'berhasil_diproses' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.peserta_didik_baru → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik_baru → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.peserta_didik_baru → ref.jenis_pendaftaran (jenis_pendaftaran_id → jenis_pendaftaran_id).
     */
    public function jenisPendaftaran(): BelongsTo
    {
        return $this->belongsTo(JenisPendaftaran::class, 'jenis_pendaftaran_id', 'jenis_pendaftaran_id');
    }

    /**
     * public.peserta_didik_baru → ref.tahun_ajaran (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }
}
