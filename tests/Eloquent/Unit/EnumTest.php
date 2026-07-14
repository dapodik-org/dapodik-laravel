<?php

use Dapodik\Laravel\Eloquent\Enums\JenisKelamin;
use Dapodik\Laravel\Eloquent\Enums\PosisiGelar;
use Dapodik\Laravel\Eloquent\Enums\StatusPerkawinan;
use Dapodik\Laravel\Eloquent\Enums\StatusSekolah;

it('jenis kelamin has laki laki case', function () {
    $this->assertEquals('L', JenisKelamin::LakiLaki->value);
});

it('jenis kelamin has perempuan case', function () {
    $this->assertEquals('P', JenisKelamin::Perempuan->value);
});

it('jenis kelamin returns correct label for laki laki', function () {
    $this->assertEquals('Laki - laki', JenisKelamin::label(JenisKelamin::LakiLaki));
});

it('jenis kelamin returns correct label for perempuan', function () {
    $this->assertEquals('Perempuan', JenisKelamin::label(JenisKelamin::Perempuan));
});

it('posisi gelar has depan case', function () {
    $this->assertEquals(1, PosisiGelar::Depan->value);
});

it('posisi gelar has belakang case', function () {
    $this->assertEquals(2, PosisiGelar::Belakang->value);
});

it('posisi gelar returns correct label for depan', function () {
    $this->assertEquals('Depan', PosisiGelar::label(PosisiGelar::Depan));
});

it('posisi gelar returns correct label for belakang', function () {
    $this->assertEquals('Belakang', PosisiGelar::label(PosisiGelar::Belakang));
});

it('status perkawinan has kawin case', function () {
    $this->assertEquals(1, StatusPerkawinan::Kawin->value);
});

it('status perkawinan has belum kawin case', function () {
    $this->assertEquals(2, StatusPerkawinan::BelumKawin->value);
});

it('status perkawinan returns correct label for kawin', function () {
    $this->assertEquals('Kawin', StatusPerkawinan::label(StatusPerkawinan::Kawin));
});

it('status perkawinan returns correct label for belum kawin', function () {
    $this->assertEquals('Belum Kawin', StatusPerkawinan::label(StatusPerkawinan::BelumKawin));
});

it('status sekolah has negeri case', function () {
    $this->assertEquals(1, StatusSekolah::Negeri->value);
});

it('status sekolah has swasta case', function () {
    $this->assertEquals(2, StatusSekolah::Swasta->value);
});

it('status sekolah returns correct label for negeri', function () {
    $this->assertEquals('Negeri', StatusSekolah::label(StatusSekolah::Negeri));
});

it('status sekolah returns correct label for swasta', function () {
    $this->assertEquals('Swasta', StatusSekolah::label(StatusSekolah::Swasta));
});
