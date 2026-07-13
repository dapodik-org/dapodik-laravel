<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruang extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_ruang';

    protected function casts(): array
    {
        return [
            'lantai' => 'decimal',
            'panjang' => 'float',
            'lebar' => 'float',
            'kapasitas' => 'decimal',
            'luas_ruang' => 'float',
            'luas_plester_m2' => 'decimal',
            'luas_plafon_m2' => 'decimal',
            'luas_dinding_m2' => 'decimal',
            'luas_daun_jendela_m2' => 'decimal',
            'luas_daun_pintu_m2' => 'decimal',
            'panj_kusen_m' => 'decimal',
            'luas_tutup_lantai_m2' => 'decimal',
            'panj_inst_listrik_m' => 'decimal',
            'jml_inst_listrik' => 'decimal',
            'panj_inst_air_m' => 'decimal',
            'jml_inst_air' => 'decimal',
            'panj_drainase_m' => 'decimal',
            'luas_finish_struktur_m2' => 'decimal',
            'luas_finish_plafon_m2' => 'decimal',
            'luas_finish_dinding_m2' => 'decimal',
            'luas_finish_kpj_m2' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.ruang → public.bangunan (id_bangunan → id_bangunan).
     */
    public function bangunan(): BelongsTo
    {
        return $this->belongsTo(Bangunan::class, 'id_bangunan', 'id_bangunan');
    }

    /**
     * public.ruang → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.ruang ← public.alat (id_ruang → id_ruang).
     */
    public function alats(): HasMany
    {
        return $this->hasMany(Alat::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.ruang ← public.buku (id_ruang → id_ruang).
     */
    public function bukus(): HasMany
    {
        return $this->hasMany(Buku::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.ruang ← public.jadwal (id_ruang → id_ruang).
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.ruang ← public.rombongan_belajar (id_ruang → id_ruang).
     */
    public function rombonganBelajars(): HasMany
    {
        return $this->hasMany(RombonganBelajar::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.ruang ← public.ruang_longitudinal (id_ruang → id_ruang).
     */
    public function ruangLongitudinals(): HasMany
    {
        return $this->hasMany(RuangLongitudinal::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.ruang ← public.tugas_tambahan (id_ruang → id_ruang).
     */
    public function tugasTambahans(): HasMany
    {
        return $this->hasMany(TugasTambahan::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.ruang → public.bangunan (id_bangunan → id_bangunan).
     */

    /**
     * public.ruang → public.ruang (parent_id_ruang → id_ruang).
     */
    public function parentIdRuang(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id_ruang', 'id_ruang');
    }

    /**
     * public.ruang → public.sekolah (sekolah_id → sekolah_id).
     */

    /**
     * public.ruang ← public.alat (id_ruang → id_ruang).
     */

    /**
     * public.ruang ← public.buku (id_ruang → id_ruang).
     */

    /**
     * public.ruang ← public.jadwal (id_ruang → id_ruang).
     */

    /**
     * public.ruang ← public.rombongan_belajar (id_ruang → id_ruang).
     */

    /**
     * public.ruang ← public.ruang (id_ruang → parent_id_ruang).
     */
    public function ruangs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id_ruang', 'id_ruang');
    }

    /*
     * public.ruang ← public.ruang_longitudinal (id_ruang → id_ruang)
     */

    /*
     * public.ruang ← public.tugas_tambahan (id_ruang → id_ruang)
     */
}
