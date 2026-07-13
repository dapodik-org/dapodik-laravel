<?php

namespace Dapodik\Laravel\Eloquent\Tests\Unit;

use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Dapodik\Laravel\Eloquent\Types\JenisKelamin;
use Dapodik\Laravel\Eloquent\Types\PosisiGelar;
use Dapodik\Laravel\Eloquent\Types\StatusPerkawinan;
use Dapodik\Laravel\Eloquent\Types\StatusSekolah;

class TypesTest extends TestCase
{
    /** @test */
    public function jenis_kelamin_has_laki_laki_constant()
    {
        $this->assertEquals('L', JenisKelamin::LakiLaki);
    }

    /** @test */
    public function jenis_kelamin_has_perempuan_constant()
    {
        $this->assertEquals('P', JenisKelamin::Perempuan);
    }

    /** @test */
    public function jenis_kelamin_returns_correct_label_for_laki_laki()
    {
        $this->assertEquals('Laki - laki', JenisKelamin::label(JenisKelamin::LakiLaki));
    }

    /** @test */
    public function jenis_kelamin_returns_correct_label_for_perempuan()
    {
        $this->assertEquals('Perempuan', JenisKelamin::label(JenisKelamin::Perempuan));
    }

    /** @test */
    public function posisi_gelar_has_depan_constant()
    {
        $this->assertEquals(1, PosisiGelar::Depan);
    }

    /** @test */
    public function posisi_gelar_has_belakang_constant()
    {
        $this->assertEquals(2, PosisiGelar::Belakang);
    }

    /** @test */
    public function posisi_gelar_returns_correct_label_for_depan()
    {
        $this->assertEquals('Depan', PosisiGelar::label(PosisiGelar::Depan));
    }

    /** @test */
    public function posisi_gelar_returns_correct_label_for_belakang()
    {
        $this->assertEquals('Belakang', PosisiGelar::label(PosisiGelar::Belakang));
    }

    /** @test */
    public function status_perkawinan_has_kawin_constant()
    {
        $this->assertEquals(1, StatusPerkawinan::Kawin);
    }

    /** @test */
    public function status_perkawinan_has_belum_kawin_constant()
    {
        $this->assertEquals(2, StatusPerkawinan::BelumKawin);
    }

    /** @test */
    public function status_perkawinan_returns_correct_label_for_kawin()
    {
        $this->assertEquals('Kawin', StatusPerkawinan::label(StatusPerkawinan::Kawin));
    }

    /** @test */
    public function status_perkawinan_returns_correct_label_for_belum_kawin()
    {
        $this->assertEquals('Belum Kawin', StatusPerkawinan::label(StatusPerkawinan::BelumKawin));
    }

    /** @test */
    public function status_sekolah_has_negeri_constant()
    {
        $this->assertEquals(1, StatusSekolah::Negeri);
    }

    /** @test */
    public function status_sekolah_has_swasta_constant()
    {
        $this->assertEquals(2, StatusSekolah::Swasta);
    }

    /** @test */
    public function status_sekolah_returns_correct_label_for_negeri()
    {
        $this->assertEquals('Negeri', StatusSekolah::label(StatusSekolah::Negeri));
    }

    /** @test */
    public function status_sekolah_returns_correct_label_for_swasta()
    {
        $this->assertEquals('Swasta', StatusSekolah::label(StatusSekolah::Swasta));
    }
}
