<?php

namespace Dapodik\Laravel\Eloquent;

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentDatabaseCreateCommand;
use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentPublishCommand;
use Dapodik\Laravel\Eloquent\Models\AkreditasiProdi;
use Dapodik\Laravel\Eloquent\Models\AkreditasiSp;
use Dapodik\Laravel\Eloquent\Models\AktivitasKepanitiaan;
use Dapodik\Laravel\Eloquent\Models\AktPd;
use Dapodik\Laravel\Eloquent\Models\Alat;
use Dapodik\Laravel\Eloquent\Models\AlatDariBlockgrant;
use Dapodik\Laravel\Eloquent\Models\AlatLongitudinal;
use Dapodik\Laravel\Eloquent\Models\Anak;
use Dapodik\Laravel\Eloquent\Models\AnggotaAktPd;
use Dapodik\Laravel\Eloquent\Models\AnggotaGugus;
use Dapodik\Laravel\Eloquent\Models\AnggotaPanitia;
use Dapodik\Laravel\Eloquent\Models\AnggotaRombel;
use Dapodik\Laravel\Eloquent\Models\Angkutan;
use Dapodik\Laravel\Eloquent\Models\AngkutanDariBlockgrant;
use Dapodik\Laravel\Eloquent\Models\Audit\LoggedActions;
use Dapodik\Laravel\Eloquent\Models\Author;
use Dapodik\Laravel\Eloquent\Models\Bangunan;
use Dapodik\Laravel\Eloquent\Models\BangunanDariBlockgrant;
use Dapodik\Laravel\Eloquent\Models\BangunanLongitudinal;
use Dapodik\Laravel\Eloquent\Models\BantuanPd;
use Dapodik\Laravel\Eloquent\Models\BeasiswaPesertaDidik;
use Dapodik\Laravel\Eloquent\Models\BeasiswaPtk;
use Dapodik\Laravel\Eloquent\Models\BidangSdm;
use Dapodik\Laravel\Eloquent\Models\BimbingPd;
use Dapodik\Laravel\Eloquent\Models\Blob\LargeObject;
use Dapodik\Laravel\Eloquent\Models\Blockgrant;
use Dapodik\Laravel\Eloquent\Models\Buku;
use Dapodik\Laravel\Eloquent\Models\BukuLongitudinal;
use Dapodik\Laravel\Eloquent\Models\BukuPelajaran;
use Dapodik\Laravel\Eloquent\Models\BukuPtk;
use Dapodik\Laravel\Eloquent\Models\DataDynamic;
use Dapodik\Laravel\Eloquent\Models\DayaTampung;
use Dapodik\Laravel\Eloquent\Models\Demografi;
use Dapodik\Laravel\Eloquent\Models\Diklat;
use Dapodik\Laravel\Eloquent\Models\Dudi;
use Dapodik\Laravel\Eloquent\Models\Eloquent\SyncStatus;
use Dapodik\Laravel\Eloquent\Models\GugusSekolah;
use Dapodik\Laravel\Eloquent\Models\GuruSasaranPengawas;
use Dapodik\Laravel\Eloquent\Models\IjazahPd;
use Dapodik\Laravel\Eloquent\Models\Inpassing;
use Dapodik\Laravel\Eloquent\Models\Instalasi;
use Dapodik\Laravel\Eloquent\Models\Internet;
use Dapodik\Laravel\Eloquent\Models\IzinOperasional;
use Dapodik\Laravel\Eloquent\Models\Jadwal;
use Dapodik\Laravel\Eloquent\Models\JurSpLong;
use Dapodik\Laravel\Eloquent\Models\JurusanKerjasama;
use Dapodik\Laravel\Eloquent\Models\JurusanSp;
use Dapodik\Laravel\Eloquent\Models\KaryaTulis;
use Dapodik\Laravel\Eloquent\Models\KelasEkskul;
use Dapodik\Laravel\Eloquent\Models\Kepanitiaan;
use Dapodik\Laravel\Eloquent\Models\Kesejahteraan;
use Dapodik\Laravel\Eloquent\Models\KesejahteraanPd;
use Dapodik\Laravel\Eloquent\Models\KitasPd;
use Dapodik\Laravel\Eloquent\Models\KitasPtk;
use Dapodik\Laravel\Eloquent\Models\LayananKhusus;
use Dapodik\Laravel\Eloquent\Models\LembagaNonSekolah;
use Dapodik\Laravel\Eloquent\Models\Listrik;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Aplikasi;
use Dapodik\Laravel\Eloquent\Models\ManAkses\LogOtentikasi;
use Dapodik\Laravel\Eloquent\Models\ManAkses\LogOtorisasi;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Menu;
use Dapodik\Laravel\Eloquent\Models\ManAkses\MenuRole;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Pengguna;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Peran;
use Dapodik\Laravel\Eloquent\Models\ManAkses\RolePengguna;
use Dapodik\Laravel\Eloquent\Models\Mou;
use Dapodik\Laravel\Eloquent\Models\Naungan;
use Dapodik\Laravel\Eloquent\Models\Nilai\MatevRapor;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiEkskul;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiRapor;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiSmt;
use Dapodik\Laravel\Eloquent\Models\Nilai\Un;
use Dapodik\Laravel\Eloquent\Models\NilaiTest;
use Dapodik\Laravel\Eloquent\Models\PasporPd;
use Dapodik\Laravel\Eloquent\Models\PasporPtk;
use Dapodik\Laravel\Eloquent\Models\Pembelajaran;
use Dapodik\Laravel\Eloquent\Models\PengawasTerdaftar;
use Dapodik\Laravel\Eloquent\Models\Penghargaan;
use Dapodik\Laravel\Eloquent\Models\Pesan;
use Dapodik\Laravel\Eloquent\Models\PesertaDidik;
use Dapodik\Laravel\Eloquent\Models\PesertaDidikBaru;
use Dapodik\Laravel\Eloquent\Models\PesertaDidikLongitudinal;
use Dapodik\Laravel\Eloquent\Models\Prestasi;
use Dapodik\Laravel\Eloquent\Models\ProgramInklusi;
use Dapodik\Laravel\Eloquent\Models\Ptk;
use Dapodik\Laravel\Eloquent\Models\PtkBaru;
use Dapodik\Laravel\Eloquent\Models\PtkTerdaftar;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Biblio;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Classifications;
use Dapodik\Laravel\Eloquent\Models\Pustaka\DaftarAuthor;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Frequency;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Gmd;
use Dapodik\Laravel\Eloquent\Models\Pustaka\MapelBiblio;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Publisher;
use Dapodik\Laravel\Eloquent\Models\Pustaka\TingkatBiblio;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Dapodik\Laravel\Eloquent\Models\Ref\Akreditasi;
use Dapodik\Laravel\Eloquent\Models\Ref\AksesInternet;
use Dapodik\Laravel\Eloquent\Models\Ref\AlasanLayakPip;
use Dapodik\Laravel\Eloquent\Models\Ref\AlatTransportasi;
use Dapodik\Laravel\Eloquent\Models\Ref\Bank;
use Dapodik\Laravel\Eloquent\Models\Ref\BatasWaktuRapor;
use Dapodik\Laravel\Eloquent\Models\Ref\BentukLembaga;
use Dapodik\Laravel\Eloquent\Models\Ref\BentukPendidikan;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangStudi;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangUsaha;
use Dapodik\Laravel\Eloquent\Models\Ref\EkstraKurikuler;
use Dapodik\Laravel\Eloquent\Models\Ref\Errortype;
use Dapodik\Laravel\Eloquent\Models\Ref\FasilitasLayanan;
use Dapodik\Laravel\Eloquent\Models\Ref\GelarAkademik;
use Dapodik\Laravel\Eloquent\Models\Ref\GroupMatpel;
use Dapodik\Laravel\Eloquent\Models\Ref\JabatanFungsional;
use Dapodik\Laravel\Eloquent\Models\Ref\JabatanPtk;
use Dapodik\Laravel\Eloquent\Models\Ref\JabatanTugasPtk;
use Dapodik\Laravel\Eloquent\Models\Ref\JadwalPaud;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisAktivitasKepanitiaan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisAktPd;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisBantuan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisBeasiswa;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisCita;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisDiklat;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisGugus;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisHapusBuku;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisHobby;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisIjazah;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKeluar;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKepanitiaan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKerusakan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKesejahteraan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKoneksi;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKs;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisLayananInternet;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisLembaga;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisLk;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPendaftaran;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPenghargaan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPesan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPrasarana;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPrestasi;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPtk;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisRombel;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisSarana;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisSertifikasi;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisTest;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisTinggal;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisTunjangan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenjangKepengawasan;
use Dapodik\Laravel\Eloquent\Models\Ref\JenjangPendidikan;
use Dapodik\Laravel\Eloquent\Models\Ref\Jurusan;
use Dapodik\Laravel\Eloquent\Models\Ref\KategoriDesa;
use Dapodik\Laravel\Eloquent\Models\Ref\KategoriTk;
use Dapodik\Laravel\Eloquent\Models\Ref\KeahlianLaboratorium;
use Dapodik\Laravel\Eloquent\Models\Ref\KebutuhanKhusus;
use Dapodik\Laravel\Eloquent\Models\Ref\KelompokBidang;
use Dapodik\Laravel\Eloquent\Models\Ref\KelompokUsaha;
use Dapodik\Laravel\Eloquent\Models\Ref\KlasifikasiLembaga;
use Dapodik\Laravel\Eloquent\Models\Ref\Kompetensi;
use Dapodik\Laravel\Eloquent\Models\Ref\Kurikulum;
use Dapodik\Laravel\Eloquent\Models\Ref\LembagaAkreditasi;
use Dapodik\Laravel\Eloquent\Models\Ref\LembagaPengangkat;
use Dapodik\Laravel\Eloquent\Models\Ref\LembSertifikasi;
use Dapodik\Laravel\Eloquent\Models\Ref\LevelWilayah;
use Dapodik\Laravel\Eloquent\Models\Ref\MapBidangMataPelajaran;
use Dapodik\Laravel\Eloquent\Models\Ref\MataPelajaran;
use Dapodik\Laravel\Eloquent\Models\Ref\MataPelajaranKurikulum;
use Dapodik\Laravel\Eloquent\Models\Ref\MstWilayah;
use Dapodik\Laravel\Eloquent\Models\Ref\Mulok;
use Dapodik\Laravel\Eloquent\Models\Ref\Negara;
use Dapodik\Laravel\Eloquent\Models\Ref\PangkatGolongan;
use Dapodik\Laravel\Eloquent\Models\Ref\Pekerjaan;
use Dapodik\Laravel\Eloquent\Models\Ref\PemakaiPrasarana;
use Dapodik\Laravel\Eloquent\Models\Ref\PemakaiSarana;
use Dapodik\Laravel\Eloquent\Models\Ref\Penghasilan;
use Dapodik\Laravel\Eloquent\Models\Ref\SasaranBlockgrant;
use Dapodik\Laravel\Eloquent\Models\Ref\Semester;
use Dapodik\Laravel\Eloquent\Models\Ref\SertifikasiIso;
use Dapodik\Laravel\Eloquent\Models\Ref\StandarSarana;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusAnak;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusDiKurikulum;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusKeaktifanPegawai;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusKepegawaian;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusKepemilikan;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusKepemilikanSarpras;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberAir;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberDana;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberDanaSekolah;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberGaji;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberListrik;
use Dapodik\Laravel\Eloquent\Models\Ref\TableSync;
use Dapodik\Laravel\Eloquent\Models\Ref\TahunAjaran;
use Dapodik\Laravel\Eloquent\Models\Ref\TemplateRapor;
use Dapodik\Laravel\Eloquent\Models\Ref\TemplateUn;
use Dapodik\Laravel\Eloquent\Models\Ref\TetanggaKabkota;
use Dapodik\Laravel\Eloquent\Models\Ref\TingkatPendidikan;
use Dapodik\Laravel\Eloquent\Models\Ref\TingkatPenghargaan;
use Dapodik\Laravel\Eloquent\Models\Ref\TingkatPrestasi;
use Dapodik\Laravel\Eloquent\Models\Ref\Variabel;
use Dapodik\Laravel\Eloquent\Models\Ref\VariabelValue;
use Dapodik\Laravel\Eloquent\Models\Ref\WaktuPenyelenggaraan;
use Dapodik\Laravel\Eloquent\Models\RegistrasiPesertaDidik;
use Dapodik\Laravel\Eloquent\Models\RiwayatGajiBerkala;
use Dapodik\Laravel\Eloquent\Models\RombonganBelajar;
use Dapodik\Laravel\Eloquent\Models\Ruang;
use Dapodik\Laravel\Eloquent\Models\RuangLongitudinal;
use Dapodik\Laravel\Eloquent\Models\RwyFungsional;
use Dapodik\Laravel\Eloquent\Models\RwyKepangkatan;
use Dapodik\Laravel\Eloquent\Models\RwyKerja;
use Dapodik\Laravel\Eloquent\Models\RwyPendFormal;
use Dapodik\Laravel\Eloquent\Models\RwySertifikasi;
use Dapodik\Laravel\Eloquent\Models\RwyStruktural;
use Dapodik\Laravel\Eloquent\Models\Sanitasi;
use Dapodik\Laravel\Eloquent\Models\SasaranPengawasan;
use Dapodik\Laravel\Eloquent\Models\Sekolah;
use Dapodik\Laravel\Eloquent\Models\SekolahLongitudinal;
use Dapodik\Laravel\Eloquent\Models\SekolahPaud;
use Dapodik\Laravel\Eloquent\Models\SertifikasiPd;
use Dapodik\Laravel\Eloquent\Models\SyncLog;
use Dapodik\Laravel\Eloquent\Models\SyncPrimer;
use Dapodik\Laravel\Eloquent\Models\SyncSession;
use Dapodik\Laravel\Eloquent\Models\TableSyncLog;
use Dapodik\Laravel\Eloquent\Models\Tanah;
use Dapodik\Laravel\Eloquent\Models\TanahDariBlockgrant;
use Dapodik\Laravel\Eloquent\Models\TanahLongitudinal;
use Dapodik\Laravel\Eloquent\Models\TracerLulusan;
use Dapodik\Laravel\Eloquent\Models\TugasTambahan;
use Dapodik\Laravel\Eloquent\Models\Tunjangan;
use Dapodik\Laravel\Eloquent\Models\UnitUsaha;
use Dapodik\Laravel\Eloquent\Models\UnitUsahaKerjasama;
use Dapodik\Laravel\Eloquent\Models\Validasi;
use Dapodik\Laravel\Eloquent\Models\VersiDb;
use Dapodik\Laravel\Eloquent\Models\VldAktPd;
use Dapodik\Laravel\Eloquent\Models\VldAlat;
use Dapodik\Laravel\Eloquent\Models\VldAnak;
use Dapodik\Laravel\Eloquent\Models\VldAngkutan;
use Dapodik\Laravel\Eloquent\Models\VldBangunan;
use Dapodik\Laravel\Eloquent\Models\VldBeaPd;
use Dapodik\Laravel\Eloquent\Models\VldBeaPtk;
use Dapodik\Laravel\Eloquent\Models\VldBukuPtk;
use Dapodik\Laravel\Eloquent\Models\VldDemografi;
use Dapodik\Laravel\Eloquent\Models\VldDudi;
use Dapodik\Laravel\Eloquent\Models\VldInpassing;
use Dapodik\Laravel\Eloquent\Models\VldJurusanSp;
use Dapodik\Laravel\Eloquent\Models\VldKaryaTulis;
use Dapodik\Laravel\Eloquent\Models\VldKesejahteraan;
use Dapodik\Laravel\Eloquent\Models\VldMou;
use Dapodik\Laravel\Eloquent\Models\VldNilaiRapor;
use Dapodik\Laravel\Eloquent\Models\VldNilaiTest;
use Dapodik\Laravel\Eloquent\Models\VldNonsekolah;
use Dapodik\Laravel\Eloquent\Models\VldPdLong;
use Dapodik\Laravel\Eloquent\Models\VldPembelajaran;
use Dapodik\Laravel\Eloquent\Models\VldPenghargaan;
use Dapodik\Laravel\Eloquent\Models\VldPesertaDidik;
use Dapodik\Laravel\Eloquent\Models\VldPrestasi;
use Dapodik\Laravel\Eloquent\Models\VldPtk;
use Dapodik\Laravel\Eloquent\Models\VldPtkTerdaftar;
use Dapodik\Laravel\Eloquent\Models\VldRegPd;
use Dapodik\Laravel\Eloquent\Models\VldRombel;
use Dapodik\Laravel\Eloquent\Models\VldRwyFungsional;
use Dapodik\Laravel\Eloquent\Models\VldRwyKepangkatan;
use Dapodik\Laravel\Eloquent\Models\VldRwyKerja;
use Dapodik\Laravel\Eloquent\Models\VldRwyPendFormal;
use Dapodik\Laravel\Eloquent\Models\VldRwySertifikasi;
use Dapodik\Laravel\Eloquent\Models\VldRwyStruktural;
use Dapodik\Laravel\Eloquent\Models\VldSekolah;
use Dapodik\Laravel\Eloquent\Models\VldTanah;
use Dapodik\Laravel\Eloquent\Models\VldTugasTambahan;
use Dapodik\Laravel\Eloquent\Models\VldTunjangan;
use Dapodik\Laravel\Eloquent\Models\VldUn;
use Dapodik\Laravel\Eloquent\Models\VldYayasan;
use Dapodik\Laravel\Eloquent\Models\Yayasan;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class EloquentServiceProvider extends ServiceProvider
{
    private const MIGRATION_MODEL_MAP = [
        'create_dapodik_level_wilayah_table' => ['table' => 'level_wilayah', 'model' => LevelWilayah::class],
        'create_dapodik_negara_table' => ['table' => 'negara', 'model' => Negara::class],
        'create_dapodik_kategori_desa_table' => ['table' => 'kategori_desa', 'model' => KategoriDesa::class],
        'create_dapodik_mst_wilayah_table' => ['table' => 'mst_wilayah', 'model' => MstWilayah::class],
        'create_dapodik_agama_table' => ['table' => 'agama', 'model' => Agama::class],
        'create_dapodik_akreditasi_table' => ['table' => 'akreditasi', 'model' => Akreditasi::class],
        'create_dapodik_akses_internet_table' => ['table' => 'akses_internet', 'model' => AksesInternet::class],
        'create_dapodik_alasan_layak_pip_table' => ['table' => 'alasan_layak_pip', 'model' => AlasanLayakPip::class],
        'create_dapodik_alat_transportasi_table' => ['table' => 'alat_transportasi', 'model' => AlatTransportasi::class],
        'create_dapodik_bank_table' => ['table' => 'bank', 'model' => Bank::class],
        'create_dapodik_bentuk_lembaga_table' => ['table' => 'bentuk_lembaga', 'model' => BentukLembaga::class],
        'create_dapodik_bentuk_pendidikan_table' => ['table' => 'bentuk_pendidikan', 'model' => BentukPendidikan::class],
        'create_dapodik_bidang_studi_table' => ['table' => 'bidang_studi', 'model' => BidangStudi::class],
        'create_dapodik_bidang_usaha_table' => ['table' => 'bidang_usaha', 'model' => BidangUsaha::class],
        'create_dapodik_ekstra_kurikuler_table' => ['table' => 'ekstra_kurikuler', 'model' => EkstraKurikuler::class],
        'create_dapodik_errortype_table' => ['table' => 'errortype', 'model' => Errortype::class],
        'create_dapodik_fasilitas_layanan_table' => ['table' => 'fasilitas_layanan', 'model' => FasilitasLayanan::class],
        'create_dapodik_gelar_akademik_table' => ['table' => 'gelar_akademik', 'model' => GelarAkademik::class],
        'create_dapodik_jabatan_fungsional_table' => ['table' => 'jabatan_fungsional', 'model' => JabatanFungsional::class],
        'create_dapodik_jenis_ptk_table' => ['table' => 'jenis_ptk', 'model' => JenisPtk::class],
        'create_dapodik_jabatan_ptk_table' => ['table' => 'jabatan_ptk', 'model' => JabatanPtk::class],
        'create_dapodik_jabatan_tugas_ptk_table' => ['table' => 'jabatan_tugas_ptk', 'model' => JabatanTugasPtk::class],
        'create_dapodik_jadwal_paud_table' => ['table' => 'jadwal_paud', 'model' => JadwalPaud::class],
        'create_dapodik_jenis_akt_pd_table' => ['table' => 'jenis_akt_pd', 'model' => JenisAktPd::class],
        'create_dapodik_jenis_aktivitas_kepanitiaan_table' => ['table' => 'jenis_aktivitas_kepanitiaan', 'model' => JenisAktivitasKepanitiaan::class],
        'create_dapodik_jenis_bantuan_table' => ['table' => 'jenis_bantuan', 'model' => JenisBantuan::class],
        'create_dapodik_sumber_dana_table' => ['table' => 'sumber_dana', 'model' => SumberDana::class],
        'create_dapodik_jenis_beasiswa_table' => ['table' => 'jenis_beasiswa', 'model' => JenisBeasiswa::class],
        'create_dapodik_jenis_cita_table' => ['table' => 'jenis_cita', 'model' => JenisCita::class],
        'create_dapodik_jenis_diklat_table' => ['table' => 'jenis_diklat', 'model' => JenisDiklat::class],
        'create_dapodik_jenis_gugus_table' => ['table' => 'jenis_gugus', 'model' => JenisGugus::class],
        'create_dapodik_jenis_hapus_buku_table' => ['table' => 'jenis_hapus_buku', 'model' => JenisHapusBuku::class],
        'create_dapodik_jenis_hobby_table' => ['table' => 'jenis_hobby', 'model' => JenisHobby::class],
        'create_dapodik_jenis_ijazah_table' => ['table' => 'jenis_ijazah', 'model' => JenisIjazah::class],
        'create_dapodik_jenis_keluar_table' => ['table' => 'jenis_keluar', 'model' => JenisKeluar::class],
        'create_dapodik_jenis_kepanitiaan_table' => ['table' => 'jenis_kepanitiaan', 'model' => JenisKepanitiaan::class],
        'create_dapodik_jenis_kerusakan_table' => ['table' => 'jenis_kerusakan', 'model' => JenisKerusakan::class],
        'create_dapodik_jenis_kesejahteraan_table' => ['table' => 'jenis_kesejahteraan', 'model' => JenisKesejahteraan::class],
        'create_dapodik_jenis_koneksi_table' => ['table' => 'jenis_koneksi', 'model' => JenisKoneksi::class],
        'create_dapodik_jenis_ks_table' => ['table' => 'jenis_ks', 'model' => JenisKs::class],
        'create_dapodik_jenis_layanan_internet_table' => ['table' => 'jenis_layanan_internet', 'model' => JenisLayananInternet::class],
        'create_dapodik_jenis_lembaga_table' => ['table' => 'jenis_lembaga', 'model' => JenisLembaga::class],
        'create_dapodik_jenis_lk_table' => ['table' => 'jenis_lk', 'model' => JenisLk::class],
        'create_dapodik_jenis_pendaftaran_table' => ['table' => 'jenis_pendaftaran', 'model' => JenisPendaftaran::class],
        'create_dapodik_jenis_penghargaan_table' => ['table' => 'jenis_penghargaan', 'model' => JenisPenghargaan::class],
        'create_dapodik_jenis_prasarana_table' => ['table' => 'jenis_prasarana', 'model' => JenisPrasarana::class],
        'create_dapodik_jenis_prestasi_table' => ['table' => 'jenis_prestasi', 'model' => JenisPrestasi::class],
        'create_dapodik_jenis_rombel_table' => ['table' => 'jenis_rombel', 'model' => JenisRombel::class],
        'create_dapodik_jenis_sarana_table' => ['table' => 'jenis_sarana', 'model' => JenisSarana::class],
        'create_dapodik_jenis_test_table' => ['table' => 'jenis_test', 'model' => JenisTest::class],
        'create_dapodik_jenis_tinggal_table' => ['table' => 'jenis_tinggal', 'model' => JenisTinggal::class],
        'create_dapodik_jenis_tunjangan_table' => ['table' => 'jenis_tunjangan', 'model' => JenisTunjangan::class],
        'create_dapodik_jenjang_kepengawasan_table' => ['table' => 'jenjang_kepengawasan', 'model' => JenjangKepengawasan::class],
        'create_dapodik_jenjang_pendidikan_table' => ['table' => 'jenjang_pendidikan', 'model' => JenjangPendidikan::class],
        'create_dapodik_kategori_tk_table' => ['table' => 'kategori_tk', 'model' => KategoriTk::class],
        'create_dapodik_keahlian_laboratorium_table' => ['table' => 'keahlian_laboratorium', 'model' => KeahlianLaboratorium::class],
        'create_dapodik_kebutuhan_khusus_table' => ['table' => 'kebutuhan_khusus', 'model' => KebutuhanKhusus::class],
        'create_dapodik_kelompok_bidang_table' => ['table' => 'kelompok_bidang', 'model' => KelompokBidang::class],
        'create_dapodik_jenis_sertifikasi_table' => ['table' => 'jenis_sertifikasi', 'model' => JenisSertifikasi::class],
        'create_dapodik_jurusan_table' => ['table' => 'jurusan', 'model' => Jurusan::class],
        'create_dapodik_kelompok_usaha_table' => ['table' => 'kelompok_usaha', 'model' => KelompokUsaha::class],
        'create_dapodik_klasifikasi_lembaga_table' => ['table' => 'klasifikasi_lembaga', 'model' => KlasifikasiLembaga::class],
        'create_dapodik_kurikulum_table' => ['table' => 'kurikulum', 'model' => Kurikulum::class],
        'create_dapodik_lemb_sertifikasi_table' => ['table' => 'lemb_sertifikasi', 'model' => LembSertifikasi::class],
        'create_dapodik_lembaga_akreditasi_table' => ['table' => 'lembaga_akreditasi', 'model' => LembagaAkreditasi::class],
        'create_dapodik_lembaga_pengangkat_table' => ['table' => 'lembaga_pengangkat', 'model' => LembagaPengangkat::class],
        'create_dapodik_mata_pelajaran_table' => ['table' => 'mata_pelajaran', 'model' => MataPelajaran::class],
        'create_dapodik_status_di_kurikulum_table' => ['table' => 'status_di_kurikulum', 'model' => StatusDiKurikulum::class],
        'create_dapodik_tingkat_pendidikan_table' => ['table' => 'tingkat_pendidikan', 'model' => TingkatPendidikan::class],
        'create_dapodik_mata_pelajaran_kurikulum_table' => ['table' => 'mata_pelajaran_kurikulum', 'model' => MataPelajaranKurikulum::class],
        'create_dapodik_pangkat_golongan_table' => ['table' => 'pangkat_golongan', 'model' => PangkatGolongan::class],
        'create_dapodik_pekerjaan_table' => ['table' => 'pekerjaan', 'model' => Pekerjaan::class],
        'create_dapodik_pemakai_prasarana_table' => ['table' => 'pemakai_prasarana', 'model' => PemakaiPrasarana::class],
        'create_dapodik_pemakai_sarana_table' => ['table' => 'pemakai_sarana', 'model' => PemakaiSarana::class],
        'create_dapodik_penghasilan_table' => ['table' => 'penghasilan', 'model' => Penghasilan::class],
        'create_dapodik_tahun_ajaran_table' => ['table' => 'tahun_ajaran', 'model' => TahunAjaran::class],
        'create_dapodik_semester_table' => ['table' => 'semester', 'model' => Semester::class],
        'create_dapodik_sertifikasi_iso_table' => ['table' => 'sertifikasi_iso', 'model' => SertifikasiIso::class],
        'create_dapodik_standar_sarana_table' => ['table' => 'standar_sarana', 'model' => StandarSarana::class],
        'create_dapodik_status_anak_table' => ['table' => 'status_anak', 'model' => StatusAnak::class],
        'create_dapodik_status_keaktifan_pegawai_table' => ['table' => 'status_keaktifan_pegawai', 'model' => StatusKeaktifanPegawai::class],
        'create_dapodik_status_kepegawaian_table' => ['table' => 'status_kepegawaian', 'model' => StatusKepegawaian::class],
        'create_dapodik_status_kepemilikan_table' => ['table' => 'status_kepemilikan', 'model' => StatusKepemilikan::class],
        'create_dapodik_status_kepemilikan_sarpras_table' => ['table' => 'status_kepemilikan_sarpras', 'model' => StatusKepemilikanSarpras::class],
        'create_dapodik_sumber_air_table' => ['table' => 'sumber_air', 'model' => SumberAir::class],
        'create_dapodik_sumber_dana_sekolah_table' => ['table' => 'sumber_dana_sekolah', 'model' => SumberDanaSekolah::class],
        'create_dapodik_sumber_gaji_table' => ['table' => 'sumber_gaji', 'model' => SumberGaji::class],
        'create_dapodik_sumber_listrik_table' => ['table' => 'sumber_listrik', 'model' => SumberListrik::class],
        'create_dapodik_tingkat_penghargaan_table' => ['table' => 'tingkat_penghargaan', 'model' => TingkatPenghargaan::class],
        'create_dapodik_tingkat_prestasi_table' => ['table' => 'tingkat_prestasi', 'model' => TingkatPrestasi::class],
        'create_dapodik_waktu_penyelenggaraan_table' => ['table' => 'waktu_penyelenggaraan', 'model' => WaktuPenyelenggaraan::class],
        'create_dapodik_batas_waktu_rapor_table' => ['table' => 'batas_waktu_rapor', 'model' => BatasWaktuRapor::class],
        'create_dapodik_group_matpel_table' => ['table' => 'group_matpel', 'model' => GroupMatpel::class],
        'create_dapodik_jenis_pesan_table' => ['table' => 'jenis_pesan', 'model' => JenisPesan::class],
        'create_dapodik_kompetensi_table' => ['table' => 'kompetensi', 'model' => Kompetensi::class],
        'create_dapodik_map_bidang_mata_pelajaran_table' => ['table' => 'map_bidang_mata_pelajaran', 'model' => MapBidangMataPelajaran::class],
        'create_dapodik_mulok_table' => ['table' => 'mulok', 'model' => Mulok::class],
        'create_dapodik_sasaran_blockgrant_table' => ['table' => 'sasaran_blockgrant', 'model' => SasaranBlockgrant::class],
        'create_dapodik_table_sync_table' => ['table' => 'table_sync', 'model' => TableSync::class],
        'create_dapodik_template_rapor_table' => ['table' => 'template_rapor', 'model' => TemplateRapor::class],
        'create_dapodik_template_un_table' => ['table' => 'template_un', 'model' => TemplateUn::class],
        'create_dapodik_tetangga_kabkota_table' => ['table' => 'tetangga_kabkota', 'model' => TetanggaKabkota::class],
        'create_dapodik_variabel_table' => ['table' => 'variabel', 'model' => Variabel::class],
        'create_dapodik_variabel_value_table' => ['table' => 'variabel_value', 'model' => VariabelValue::class],
        'create_dapodik_akreditasi_sp_table' => ['table' => 'akreditasi_sp', 'model' => AkreditasiSp::class],
        'create_dapodik_akreditasi_prodi_table' => ['table' => 'akreditasi_prodi', 'model' => AkreditasiProdi::class],
        'create_dapodik_akt_pd_table' => ['table' => 'akt_pd', 'model' => AktPd::class],
        'create_dapodik_aktivitas_kepanitiaan_table' => ['table' => 'aktivitas_kepanitiaan', 'model' => AktivitasKepanitiaan::class],
        'create_dapodik_alat_table' => ['table' => 'alat', 'model' => Alat::class],
        'create_dapodik_alat_dari_blockgrant_table' => ['table' => 'alat_dari_blockgrant', 'model' => AlatDariBlockgrant::class],
        'create_dapodik_alat_longitudinal_table' => ['table' => 'alat_longitudinal', 'model' => AlatLongitudinal::class],
        'create_dapodik_anak_table' => ['table' => 'anak', 'model' => Anak::class],
        'create_dapodik_anggota_akt_pd_table' => ['table' => 'anggota_akt_pd', 'model' => AnggotaAktPd::class],
        'create_dapodik_anggota_gugus_table' => ['table' => 'anggota_gugus', 'model' => AnggotaGugus::class],
        'create_dapodik_anggota_panitia_table' => ['table' => 'anggota_panitia', 'model' => AnggotaPanitia::class],
        'create_dapodik_anggota_rombel_table' => ['table' => 'anggota_rombel', 'model' => AnggotaRombel::class],
        'create_dapodik_angkutan_table' => ['table' => 'angkutan', 'model' => Angkutan::class],
        'create_dapodik_angkutan_dari_blockgrant_table' => ['table' => 'angkutan_dari_blockgrant', 'model' => AngkutanDariBlockgrant::class],
        'create_dapodik_author_table' => ['table' => 'author', 'model' => Author::class],
        'create_dapodik_bangunan_table' => ['table' => 'bangunan', 'model' => Bangunan::class],
        'create_dapodik_bangunan_dari_blockgrant_table' => ['table' => 'bangunan_dari_blockgrant', 'model' => BangunanDariBlockgrant::class],
        'create_dapodik_bangunan_longitudinal_table' => ['table' => 'bangunan_longitudinal', 'model' => BangunanLongitudinal::class],
        'create_dapodik_bantuan_pd_table' => ['table' => 'bantuan_pd', 'model' => BantuanPd::class],
        'create_dapodik_beasiswa_peserta_didik_table' => ['table' => 'beasiswa_peserta_didik', 'model' => BeasiswaPesertaDidik::class],
        'create_dapodik_beasiswa_ptk_table' => ['table' => 'beasiswa_ptk', 'model' => BeasiswaPtk::class],
        'create_dapodik_bidang_sdm_table' => ['table' => 'bidang_sdm', 'model' => BidangSdm::class],
        'create_dapodik_bimbing_pd_table' => ['table' => 'bimbing_pd', 'model' => BimbingPd::class],
        'create_dapodik_blockgrant_table' => ['table' => 'blockgrant', 'model' => Blockgrant::class],
        'create_dapodik_buku_table' => ['table' => 'buku', 'model' => Buku::class],
        'create_dapodik_buku_longitudinal_table' => ['table' => 'buku_longitudinal', 'model' => BukuLongitudinal::class],
        'create_dapodik_buku_pelajaran_table' => ['table' => 'buku_pelajaran', 'model' => BukuPelajaran::class],
        'create_dapodik_buku_ptk_table' => ['table' => 'buku_ptk', 'model' => BukuPtk::class],
        'create_dapodik_data_dynamic_table' => ['table' => 'data_dynamic', 'model' => DataDynamic::class],
        'create_dapodik_daya_tampung_table' => ['table' => 'daya_tampung', 'model' => DayaTampung::class],
        'create_dapodik_demografi_table' => ['table' => 'demografi', 'model' => Demografi::class],
        'create_dapodik_diklat_table' => ['table' => 'diklat', 'model' => Diklat::class],
        'create_dapodik_dudi_table' => ['table' => 'dudi', 'model' => Dudi::class],
        'create_dapodik_gugus_sekolah_table' => ['table' => 'gugus_sekolah', 'model' => GugusSekolah::class],
        'create_dapodik_guru_sasaran_pengawas_table' => ['table' => 'guru_sasaran_pengawas', 'model' => GuruSasaranPengawas::class],
        'create_dapodik_ijazah_pd_table' => ['table' => 'ijazah_pd', 'model' => IjazahPd::class],
        'create_dapodik_inpassing_table' => ['table' => 'inpassing', 'model' => Inpassing::class],
        'create_dapodik_instalasi_table' => ['table' => 'instalasi', 'model' => Instalasi::class],
        'create_dapodik_internet_table' => ['table' => 'internet', 'model' => Internet::class],
        'create_dapodik_izin_operasional_table' => ['table' => 'izin_operasional', 'model' => IzinOperasional::class],
        'create_dapodik_jadwal_table' => ['table' => 'jadwal', 'model' => Jadwal::class],
        'create_dapodik_jur_sp_long_table' => ['table' => 'jur_sp_long', 'model' => JurSpLong::class],
        'create_dapodik_jurusan_kerjasama_table' => ['table' => 'jurusan_kerjasama', 'model' => JurusanKerjasama::class],
        'create_dapodik_jurusan_sp_table' => ['table' => 'jurusan_sp', 'model' => JurusanSp::class],
        'create_dapodik_karya_tulis_table' => ['table' => 'karya_tulis', 'model' => KaryaTulis::class],
        'create_dapodik_kelas_ekskul_table' => ['table' => 'kelas_ekskul', 'model' => KelasEkskul::class],
        'create_dapodik_kepanitiaan_table' => ['table' => 'kepanitiaan', 'model' => Kepanitiaan::class],
        'create_dapodik_kesejahteraan_table' => ['table' => 'kesejahteraan', 'model' => Kesejahteraan::class],
        'create_dapodik_kesejahteraan_pd_table' => ['table' => 'kesejahteraan_pd', 'model' => KesejahteraanPd::class],
        'create_dapodik_kitas_pd_table' => ['table' => 'kitas_pd', 'model' => KitasPd::class],
        'create_dapodik_kitas_ptk_table' => ['table' => 'kitas_ptk', 'model' => KitasPtk::class],
        'create_dapodik_layanan_khusus_table' => ['table' => 'layanan_khusus', 'model' => LayananKhusus::class],
        'create_dapodik_lembaga_non_sekolah_table' => ['table' => 'lembaga_non_sekolah', 'model' => LembagaNonSekolah::class],
        'create_dapodik_listrik_table' => ['table' => 'listrik', 'model' => Listrik::class],
        'create_dapodik_mou_table' => ['table' => 'mou', 'model' => Mou::class],
        'create_dapodik_naungan_table' => ['table' => 'naungan', 'model' => Naungan::class],
        'create_dapodik_nilai_test_table' => ['table' => 'nilai_test', 'model' => NilaiTest::class],
        'create_dapodik_paspor_pd_table' => ['table' => 'paspor_pd', 'model' => PasporPd::class],
        'create_dapodik_paspor_ptk_table' => ['table' => 'paspor_ptk', 'model' => PasporPtk::class],
        'create_dapodik_pembelajaran_table' => ['table' => 'pembelajaran', 'model' => Pembelajaran::class],
        'create_dapodik_pengawas_terdaftar_table' => ['table' => 'pengawas_terdaftar', 'model' => PengawasTerdaftar::class],
        'create_dapodik_penghargaan_table' => ['table' => 'penghargaan', 'model' => Penghargaan::class],
        'create_dapodik_pesan_table' => ['table' => 'pesan', 'model' => Pesan::class],
        'create_dapodik_peserta_didik_table' => ['table' => 'peserta_didik', 'model' => PesertaDidik::class],
        'create_dapodik_peserta_didik_baru_table' => ['table' => 'peserta_didik_baru', 'model' => PesertaDidikBaru::class],
        'create_dapodik_peserta_didik_longitudinal_table' => ['table' => 'peserta_didik_longitudinal', 'model' => PesertaDidikLongitudinal::class],
        'create_dapodik_prestasi_table' => ['table' => 'prestasi', 'model' => Prestasi::class],
        'create_dapodik_program_inklusi_table' => ['table' => 'program_inklusi', 'model' => ProgramInklusi::class],
        'create_dapodik_ptk_table' => ['table' => 'ptk', 'model' => Ptk::class],
        'create_dapodik_ptk_baru_table' => ['table' => 'ptk_baru', 'model' => PtkBaru::class],
        'create_dapodik_ptk_terdaftar_table' => ['table' => 'ptk_terdaftar', 'model' => PtkTerdaftar::class],
        'create_dapodik_registrasi_peserta_didik_table' => ['table' => 'registrasi_peserta_didik', 'model' => RegistrasiPesertaDidik::class],
        'create_dapodik_riwayat_gaji_berkala_table' => ['table' => 'riwayat_gaji_berkala', 'model' => RiwayatGajiBerkala::class],
        'create_dapodik_rombongan_belajar_table' => ['table' => 'rombongan_belajar', 'model' => RombonganBelajar::class],
        'create_dapodik_ruang_table' => ['table' => 'ruang', 'model' => Ruang::class],
        'create_dapodik_ruang_longitudinal_table' => ['table' => 'ruang_longitudinal', 'model' => RuangLongitudinal::class],
        'create_dapodik_rwy_fungsional_table' => ['table' => 'rwy_fungsional', 'model' => RwyFungsional::class],
        'create_dapodik_rwy_kepangkatan_table' => ['table' => 'rwy_kepangkatan', 'model' => RwyKepangkatan::class],
        'create_dapodik_rwy_kerja_table' => ['table' => 'rwy_kerja', 'model' => RwyKerja::class],
        'create_dapodik_rwy_pend_formal_table' => ['table' => 'rwy_pend_formal', 'model' => RwyPendFormal::class],
        'create_dapodik_rwy_sertifikasi_table' => ['table' => 'rwy_sertifikasi', 'model' => RwySertifikasi::class],
        'create_dapodik_rwy_struktural_table' => ['table' => 'rwy_struktural', 'model' => RwyStruktural::class],
        'create_dapodik_sanitasi_table' => ['table' => 'sanitasi', 'model' => Sanitasi::class],
        'create_dapodik_sasaran_pengawasan_table' => ['table' => 'sasaran_pengawasan', 'model' => SasaranPengawasan::class],
        'create_dapodik_sekolah_table' => ['table' => 'sekolah', 'model' => Sekolah::class],
        'create_dapodik_sekolah_longitudinal_table' => ['table' => 'sekolah_longitudinal', 'model' => SekolahLongitudinal::class],
        'create_dapodik_sekolah_paud_table' => ['table' => 'sekolah_paud', 'model' => SekolahPaud::class],
        'create_dapodik_sertifikasi_pd_table' => ['table' => 'sertifikasi_pd', 'model' => SertifikasiPd::class],
        'create_dapodik_sync_log_table' => ['table' => 'sync_log', 'model' => SyncLog::class],
        'create_dapodik_sync_primer_table' => ['table' => 'sync_primer', 'model' => SyncPrimer::class],
        'create_dapodik_sync_session_table' => ['table' => 'sync_session', 'model' => SyncSession::class],
        'create_dapodik_table_sync_log_table' => ['table' => 'table_sync_log', 'model' => TableSyncLog::class],
        'create_dapodik_tanah_table' => ['table' => 'tanah', 'model' => Tanah::class],
        'create_dapodik_tanah_dari_blockgrant_table' => ['table' => 'tanah_dari_blockgrant', 'model' => TanahDariBlockgrant::class],
        'create_dapodik_tanah_longitudinal_table' => ['table' => 'tanah_longitudinal', 'model' => TanahLongitudinal::class],
        'create_dapodik_tracer_lulusan_table' => ['table' => 'tracer_lulusan', 'model' => TracerLulusan::class],
        'create_dapodik_tugas_tambahan_table' => ['table' => 'tugas_tambahan', 'model' => TugasTambahan::class],
        'create_dapodik_tunjangan_table' => ['table' => 'tunjangan', 'model' => Tunjangan::class],
        'create_dapodik_unit_usaha_table' => ['table' => 'unit_usaha', 'model' => UnitUsaha::class],
        'create_dapodik_unit_usaha_kerjasama_table' => ['table' => 'unit_usaha_kerjasama', 'model' => UnitUsahaKerjasama::class],
        'create_dapodik_validasi_table' => ['table' => 'validasi', 'model' => Validasi::class],
        'create_dapodik_versi_db_table' => ['table' => 'versi_db', 'model' => VersiDb::class],
        'create_dapodik_vld_akt_pd_table' => ['table' => 'vld_akt_pd', 'model' => VldAktPd::class],
        'create_dapodik_vld_alat_table' => ['table' => 'vld_alat', 'model' => VldAlat::class],
        'create_dapodik_vld_anak_table' => ['table' => 'vld_anak', 'model' => VldAnak::class],
        'create_dapodik_vld_angkutan_table' => ['table' => 'vld_angkutan', 'model' => VldAngkutan::class],
        'create_dapodik_vld_bangunan_table' => ['table' => 'vld_bangunan', 'model' => VldBangunan::class],
        'create_dapodik_vld_bea_pd_table' => ['table' => 'vld_bea_pd', 'model' => VldBeaPd::class],
        'create_dapodik_vld_bea_ptk_table' => ['table' => 'vld_bea_ptk', 'model' => VldBeaPtk::class],
        'create_dapodik_vld_buku_ptk_table' => ['table' => 'vld_buku_ptk', 'model' => VldBukuPtk::class],
        'create_dapodik_vld_demografi_table' => ['table' => 'vld_demografi', 'model' => VldDemografi::class],
        'create_dapodik_vld_dudi_table' => ['table' => 'vld_dudi', 'model' => VldDudi::class],
        'create_dapodik_vld_inpassing_table' => ['table' => 'vld_inpassing', 'model' => VldInpassing::class],
        'create_dapodik_vld_jurusan_sp_table' => ['table' => 'vld_jurusan_sp', 'model' => VldJurusanSp::class],
        'create_dapodik_vld_karya_tulis_table' => ['table' => 'vld_karya_tulis', 'model' => VldKaryaTulis::class],
        'create_dapodik_vld_kesejahteraan_table' => ['table' => 'vld_kesejahteraan', 'model' => VldKesejahteraan::class],
        'create_dapodik_vld_mou_table' => ['table' => 'vld_mou', 'model' => VldMou::class],
        'create_dapodik_vld_nilai_rapor_table' => ['table' => 'vld_nilai_rapor', 'model' => VldNilaiRapor::class],
        'create_dapodik_vld_nilai_test_table' => ['table' => 'vld_nilai_test', 'model' => VldNilaiTest::class],
        'create_dapodik_vld_nonsekolah_table' => ['table' => 'vld_nonsekolah', 'model' => VldNonsekolah::class],
        'create_dapodik_vld_pd_long_table' => ['table' => 'vld_pd_long', 'model' => VldPdLong::class],
        'create_dapodik_vld_pembelajaran_table' => ['table' => 'vld_pembelajaran', 'model' => VldPembelajaran::class],
        'create_dapodik_vld_penghargaan_table' => ['table' => 'vld_penghargaan', 'model' => VldPenghargaan::class],
        'create_dapodik_vld_peserta_didik_table' => ['table' => 'vld_peserta_didik', 'model' => VldPesertaDidik::class],
        'create_dapodik_vld_prestasi_table' => ['table' => 'vld_prestasi', 'model' => VldPrestasi::class],
        'create_dapodik_vld_ptk_table' => ['table' => 'vld_ptk', 'model' => VldPtk::class],
        'create_dapodik_vld_ptk_terdaftar_table' => ['table' => 'vld_ptk_terdaftar', 'model' => VldPtkTerdaftar::class],
        'create_dapodik_vld_reg_pd_table' => ['table' => 'vld_reg_pd', 'model' => VldRegPd::class],
        'create_dapodik_vld_rombel_table' => ['table' => 'vld_rombel', 'model' => VldRombel::class],
        'create_dapodik_vld_rwy_fungsional_table' => ['table' => 'vld_rwy_fungsional', 'model' => VldRwyFungsional::class],
        'create_dapodik_vld_rwy_kepangkatan_table' => ['table' => 'vld_rwy_kepangkatan', 'model' => VldRwyKepangkatan::class],
        'create_dapodik_vld_rwy_kerja_table' => ['table' => 'vld_rwy_kerja', 'model' => VldRwyKerja::class],
        'create_dapodik_vld_rwy_pend_formal_table' => ['table' => 'vld_rwy_pend_formal', 'model' => VldRwyPendFormal::class],
        'create_dapodik_vld_rwy_sertifikasi_table' => ['table' => 'vld_rwy_sertifikasi', 'model' => VldRwySertifikasi::class],
        'create_dapodik_vld_rwy_struktural_table' => ['table' => 'vld_rwy_struktural', 'model' => VldRwyStruktural::class],
        'create_dapodik_vld_sekolah_table' => ['table' => 'vld_sekolah', 'model' => VldSekolah::class],
        'create_dapodik_vld_tanah_table' => ['table' => 'vld_tanah', 'model' => VldTanah::class],
        'create_dapodik_vld_tugas_tambahan_table' => ['table' => 'vld_tugas_tambahan', 'model' => VldTugasTambahan::class],
        'create_dapodik_vld_tunjangan_table' => ['table' => 'vld_tunjangan', 'model' => VldTunjangan::class],
        'create_dapodik_vld_un_table' => ['table' => 'vld_un', 'model' => VldUn::class],
        'create_dapodik_vld_yayasan_table' => ['table' => 'vld_yayasan', 'model' => VldYayasan::class],
        'create_dapodik_yayasan_table' => ['table' => 'yayasan', 'model' => Yayasan::class],
        'create_dapodik_aplikasi_table' => ['table' => 'aplikasi', 'model' => Aplikasi::class],
        'create_dapodik_log_otentikasi_table' => ['table' => 'log_otentikasi', 'model' => LogOtentikasi::class],
        'create_dapodik_log_otorisasi_table' => ['table' => 'log_otorisasi', 'model' => LogOtorisasi::class],
        'create_dapodik_menu_table' => ['table' => 'menu', 'model' => Menu::class],
        'create_dapodik_menu_role_table' => ['table' => 'menu_role', 'model' => MenuRole::class],
        'create_dapodik_pengguna_table' => ['table' => 'pengguna', 'model' => Pengguna::class],
        'create_dapodik_peran_table' => ['table' => 'peran', 'model' => Peran::class],
        'create_dapodik_role_pengguna_table' => ['table' => 'role_pengguna', 'model' => RolePengguna::class],
        'create_dapodik_biblio_table' => ['table' => 'biblio', 'model' => Biblio::class],
        'create_dapodik_classifications_table' => ['table' => 'classifications', 'model' => Classifications::class],
        'create_dapodik_daftar_author_table' => ['table' => 'daftar_author', 'model' => DaftarAuthor::class],
        'create_dapodik_frequency_table' => ['table' => 'frequency', 'model' => Frequency::class],
        'create_dapodik_gmd_table' => ['table' => 'gmd', 'model' => Gmd::class],
        'create_dapodik_mapel_biblio_table' => ['table' => 'mapel_biblio', 'model' => MapelBiblio::class],
        'create_dapodik_publisher_table' => ['table' => 'publisher', 'model' => Publisher::class],
        'create_dapodik_tingkat_biblio_table' => ['table' => 'tingkat_biblio', 'model' => TingkatBiblio::class],
        'create_dapodik_matev_rapor_table' => ['table' => 'matev_rapor', 'model' => MatevRapor::class],
        'create_dapodik_nilai_ekskul_table' => ['table' => 'nilai_ekskul', 'model' => NilaiEkskul::class],
        'create_dapodik_nilai_rapor_table' => ['table' => 'nilai_rapor', 'model' => NilaiRapor::class],
        'create_dapodik_nilai_smt_table' => ['table' => 'nilai_smt', 'model' => NilaiSmt::class],
        'create_dapodik_un_table' => ['table' => 'un', 'model' => Un::class],
        'create_dapodik_logged_actions_table' => ['table' => 'logged_actions', 'model' => LoggedActions::class],
        'create_dapodik_large_object_table' => ['table' => 'large_object', 'model' => LargeObject::class],
        'create_dapodik_eloquent_sync_status_table' => ['table' => 'eloquent_sync_status', 'model' => SyncStatus::class],
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/dapodik-eloquent.php', 'dapodik-eloquent');

        $this->app->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/dapodik-eloquent.php' => config_path('dapodik-eloquent.php'),
            ], 'dapodik-eloquent-config');

            $this->publishes(
                $this->getMigrationFiles(),
                'dapodik-eloquent-migrations'
            );

            $this->commands([
                DapodikEloquentPublishCommand::class,
                DapodikEloquentDatabaseCreateCommand::class,
            ]);
        }

        $manager = app('dapodik.eloquent.laravel');

        $this->app['events']->listen(CommandStarting::class, function(CommandStarting $event) use ($manager) {
            if ($event->command === 'migrate:fresh' && !$manager->getConfig()['skip_fresh']) {
                if ($manager->getConfig()['connection'] !== null) {
                    $manager->dropConnectionTables();
                }

                $manager->dropAllTables();
            }
        });

        $this->loadMigrations();
    }

    protected function getMigrationFiles()
    {
        $migrationsPath = __DIR__.'/database/migrations/dapodik';
        $files = glob($migrationsPath.'/*.php');
        $publishable = [];

        foreach ($files as $file) {
            $destination = $this->app->databasePath('migrations/dapodik/'.basename($file));
            $publishable[$file] = $destination;
        }

        return $publishable;
    }

    protected function loadMigrations()
    {
        $migrationsPath = $this->app->databasePath('migrations/dapodik');

        if (is_dir($migrationsPath)) {
            $excludeTables = config('dapodik-eloquent.exclude_tables', []);
            if (!empty($excludeTables)) {
                $this->removeExcludedMigrationFiles($migrationsPath, $excludeTables);
            }
            $this->loadMigrationsFrom($migrationsPath);

            return;
        }

        $this->loadMigrationsFrom(__DIR__.'/database/migrations/dapodik');
    }

    private function getExcludeTablesFromConfig()
    {
        return config('dapodik-eloquent.exclude_tables', []);
    }

    private function removeExcludedMigrationFiles($migrationsPath, array $excludeTables = [])
    {
        if (empty($excludeTables) || !is_dir($migrationsPath)) {
            return;
        }

        $files = glob($migrationsPath.'/*_create_dapodik_*_table.php');

        foreach ($files as $filePath) {
            $basename = basename($filePath);
            $basenameNoTimestamp = preg_replace('/^\d{4}_\d{2}_\d{2}_\d{6}_/', '', $basename);
            $basenameNoExt = str_replace('.php', '', $basenameNoTimestamp);

            $info = self::MIGRATION_MODEL_MAP[$basenameNoExt] ?? null;

            foreach ($excludeTables as $excluded) {
                if ($this->matchesExcludePattern($basenameNoExt, $info, $excluded)) {
                    @unlink($filePath);
                    continue 2;
                }
            }
        }
    }

    private function matchesExcludePattern($basenameNoExt, $info, $excluded)
    {
        $isRegex = Str::startsWith($excluded, '/') && Str::endsWith($excluded, '/');

        if ($isRegex) {
            if (preg_match($excluded, $basenameNoExt)) {
                return true;
            }

            if ($info !== null && (preg_match($excluded, $info['table']) || preg_match($excluded, $info['model']))) {
                return true;
            }

            return false;
        }

        if ($basenameNoExt === $excluded) {
            return true;
        }

        if ($info !== null && ($info['table'] === $excluded || $info['model'] === $excluded)) {
            return true;
        }

        return false;
    }
}
