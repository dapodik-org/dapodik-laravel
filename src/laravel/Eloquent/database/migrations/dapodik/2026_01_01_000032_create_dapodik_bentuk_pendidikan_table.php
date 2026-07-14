<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\BentukPendidikan;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = BentukPendidikan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('bentuk_pendidikan_id')->primary();
            $table->string('nama');
            $table->boolean('jenjang_paud');
            $table->boolean('jenjang_tk');
            $table->boolean('jenjang_sd');
            $table->boolean('jenjang_smp');
            $table->boolean('jenjang_sma');
            $table->boolean('jenjang_tinggi');
            $table->string('direktorat_pembinaan')->nullable();
            $table->boolean('aktif');
            $table->char('formalitas_pendidikan', 1);
            $table->timestamp('last_sync')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->softDeletes('expired_date');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
