<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RwyPendFormal;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixNullableRwyPendFormal extends Migration
{
    protected $model = RwyPendFormal::class;

    public function up()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->integer('bidang_studi_id')->nullable()->change();
            $table->decimal('jenjang_pendidikan_id', 2, 0)->nullable()->change();
            $table->uuid('ptk_id')->nullable()->change();
            $table->string('satuan_pendidikan_formal', 100)->nullable()->change();
            $table->decimal('kependidikan', 1, 0)->nullable()->change();
            $table->decimal('tahun_masuk', 4, 0)->nullable()->change();
            $table->string('nim', 50)->nullable()->change();
            $table->decimal('status_kuliah', 1, 0)->nullable()->change();
            $table->decimal('ipk', 5, 2)->nullable()->change();
            $table->uuid('updater_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->integer('bidang_studi_id')->nullable(false)->change();
            $table->decimal('jenjang_pendidikan_id', 2, 0)->nullable(false)->change();
            $table->uuid('ptk_id')->nullable(false)->change();
            $table->string('satuan_pendidikan_formal', 100)->nullable(false)->change();
            $table->decimal('kependidikan', 1, 0)->nullable(false)->change();
            $table->decimal('tahun_masuk', 4, 0)->nullable(false)->change();
            $table->string('nim', 50)->nullable(false)->change();
            $table->decimal('status_kuliah', 1, 0)->nullable(false)->change();
            $table->decimal('ipk', 5, 2)->nullable(false)->change();
            $table->uuid('updater_id')->nullable(false)->change();
        });
    }
}
