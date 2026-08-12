<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisHapusBuku;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisSarana;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusKepemilikanSarpras;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Angkutan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_angkutan';

    protected function casts(): array
    {
        return [
            'nup' => 'integer',
            'tgl_hapus_buku' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.angkutan → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.angkutan → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.angkutan ← public.angkutan_dari_blockgrant (id_angkutan → id_angkutan).
     */
    public function angkutanDariBlockgrants(): HasMany
    {
        return $this->hasMany(AngkutanDariBlockgrant::class, 'id_angkutan', 'id_angkutan');
    }

    /**
     * public.angkutan ← public.vld_angkutan (id_angkutan → id_angkutan).
     */
    public function vldAngkutans(): HasMany
    {
        return $this->hasMany(VldAngkutan::class, 'id_angkutan', 'id_angkutan');
    }

    /**
     * public.angkutan → ref.jenis_hapus_buku (id_hapus_buku → id_hapus_buku).
     */
    public function hapusBuku(): BelongsTo
    {
        return $this->belongsTo(JenisHapusBuku::class, 'id_hapus_buku', 'id_hapus_buku');
    }

    /**
     * public.angkutan → ref.status_kepemilikan_sarpras (kepemilikan_sarpras_id → kepemilikan_sarpras_id).
     */
    public function kepemilikanSarpras(): BelongsTo
    {
        return $this->belongsTo(StatusKepemilikanSarpras::class, 'kepemilikan_sarpras_id', 'kepemilikan_sarpras_id');
    }

    /**
     * public.angkutan → ref.jenis_sarana (jenis_sarana_id → jenis_sarana_id).
     */
    public function jenisSarana(): BelongsTo
    {
        return $this->belongsTo(JenisSarana::class, 'jenis_sarana_id', 'jenis_sarana_id');
    }
}
