<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\LembagaAkreditasi;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixNullableLembagaAkreditasi extends Migration
{
    protected $model = LembagaAkreditasi::class;

    public function up()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->string('alamat_jalan')->nullable()->change();
            $table->string('desa_kelurahan')->nullable()->change();
            $table->char('kode_wilayah', 8)->nullable()->change();
            $table->date('la_tgl_mulai')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->string('alamat_jalan')->nullable(false)->change();
            $table->string('desa_kelurahan')->nullable(false)->change();
            $table->char('kode_wilayah', 8)->nullable(false)->change();
            $table->date('la_tgl_mulai')->nullable(false)->change();
        });
    }
}
