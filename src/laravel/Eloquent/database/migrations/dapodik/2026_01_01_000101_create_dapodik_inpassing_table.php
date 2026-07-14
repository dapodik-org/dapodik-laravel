<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Inpassing;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Inpassing::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('inpassing_id')->primary();
            $table->decimal('pangkat_golongan_id', 2, 0);
            $table->uuid('ptk_id')->nullable();
            $table->string('no_sk_inpassing', 80);
            $table->date('tgl_sk_inpassing')->nullable();
            $table->date('tmt_inpassing');
            $table->decimal('angka_kredit', 3, 0)->default(0);
            $table->decimal('masa_kerja_tahun', 2, 0)->default(0);
            $table->decimal('masa_kerja_bulan', 2, 0)->default(0);
            $table->char('asal_data', 1)->default('1');
            $table->uuid('updater_id');
            $table->timestamp('last_sync')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->softDeletes('soft_delete');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
