<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sanitasi extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['sekolah_id', 'semester_id'];

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'ketersediaan_air' => 'decimal',
            'kecukupan_air' => 'decimal',
            'minum_siswa' => 'decimal',
            'memproses_air' => 'decimal',
            'siswa_bawa_air' => 'decimal',
            'toilet_siswa_laki' => 'decimal',
            'toilet_siswa_perempuan' => 'decimal',
            'toilet_siswa_kk' => 'decimal',
            'toilet_siswa_kecil' => 'decimal',
            'jml_jamban_l_g' => 'decimal',
            'jml_jamban_l_tg' => 'decimal',
            'jml_jamban_p_g' => 'decimal',
            'jml_jamban_p_tg' => 'decimal',
            'jml_jamban_lp_g' => 'decimal',
            'jml_jamban_lp_tg' => 'decimal',
            'tempat_cuci_tangan' => 'decimal',
            'tempat_cuci_tangan_rusak' => 'decimal',
            'a_sabun_air_mengalir' => 'decimal',
            'jamban_difabel' => 'decimal',
            'a_sedia_pembalut' => 'decimal',
            'kegiatan_cuci_tangan' => 'decimal',
            'pembuangan_air_limbah' => 'decimal',
            'a_kuras_septitank' => 'decimal',
            'a_memiliki_solokan' => 'decimal',
            'a_tempat_sampah_kelas' => 'decimal',
            'a_tempat_sampah_tutup_p' => 'decimal',
            'a_cermin_jamban_p' => 'decimal',
            'a_memiliki_tps' => 'decimal',
            'a_tps_angkut_rutin' => 'decimal',
            'a_anggaran_sanitasi' => 'decimal',
            'a_melibatkan_sanitasi_siswa' => 'decimal',
            'a_kemitraan_san_daerah' => 'decimal',
            'a_kemitraan_san_puskesmas' => 'decimal',
            'a_kemitraan_san_swasta' => 'decimal',
            'a_kemitraan_san_non_pem' => 'decimal',
            'kie_guru_cuci_tangan' => 'decimal',
            'kie_guru_haid' => 'decimal',
            'kie_guru_perawatan_toilet' => 'decimal',
            'kie_guru_keamanan_pangan' => 'decimal',
            'kie_guru_minum_air' => 'decimal',
            'kie_kelas_cuci_tangan' => 'decimal',
            'kie_kelas_haid' => 'decimal',
            'kie_kelas_perawatan_toilet' => 'decimal',
            'kie_kelas_keamanan_pangan' => 'decimal',
            'kie_kelas_minum_air' => 'decimal',
            'kie_toilet_cuci_tangan' => 'decimal',
            'kie_toilet_haid' => 'decimal',
            'kie_toilet_perawatan_toilet' => 'decimal',
            'kie_toilet_keamanan_pangan' => 'decimal',
            'kie_toilet_minum_air' => 'decimal',
            'kie_selasar_cuci_tangan' => 'decimal',
            'kie_selasar_haid' => 'decimal',
            'kie_selasar_perawatan_toilet' => 'decimal',
            'kie_selasar_keamanan_pangan' => 'decimal',
            'kie_selasar_minum_air' => 'decimal',
            'kie_uks_cuci_tangan' => 'decimal',
            'kie_uks_haid' => 'decimal',
            'kie_uks_perawatan_toilet' => 'decimal',
            'kie_uks_keamanan_pangan' => 'decimal',
            'kie_uks_minum_air' => 'decimal',
            'kie_kantin_cuci_tangan' => 'decimal',
            'kie_kantin_haid' => 'decimal',
            'kie_kantin_perawatan_toilet' => 'decimal',
            'kie_kantin_keamanan_pangan' => 'decimal',
            'kie_kantin_minum_air' => 'decimal',
        ];
    }

    /**
     * public.sanitasi → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }
}
