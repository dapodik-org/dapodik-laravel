<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Biblio;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisHapusBuku;
use Dapodik\Laravel\Eloquent\Models\Ref\MataPelajaran;
use Dapodik\Laravel\Eloquent\Models\Ref\TingkatPendidikan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_buku';

    protected function casts(): array
    {
        return [
            'tgl_hapus_buku' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.buku → public.ruang (id_ruang → id_ruang).
     */
    public function ruang(): BelongsTo
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.buku → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.buku ← public.buku_longitudinal (id_buku → id_buku).
     */
    public function bukuLongitudinals(): HasMany
    {
        return $this->hasMany(BukuLongitudinal::class, 'id_buku', 'id_buku');
    }

    /**
     * public.buku → ref.mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * public.buku → pustaka.biblio (id_biblio → id_biblio).
     */
    public function biblio(): BelongsTo
    {
        return $this->belongsTo(Biblio::class, 'id_biblio', 'id_biblio');
    }

    /**
     * public.buku → ref.tingkat_pendidikan (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */
    public function tingkatPendidikan(): BelongsTo
    {
        return $this->belongsTo(TingkatPendidikan::class, 'tingkat_pendidikan_id', 'tingkat_pendidikan_id');
    }

    /**
     * public.buku → ref.jenis_hapus_buku (id_hapus_buku → id_hapus_buku).
     */
    public function hapusBuku(): BelongsTo
    {
        return $this->belongsTo(JenisHapusBuku::class, 'id_hapus_buku', 'id_hapus_buku');
    }
}
