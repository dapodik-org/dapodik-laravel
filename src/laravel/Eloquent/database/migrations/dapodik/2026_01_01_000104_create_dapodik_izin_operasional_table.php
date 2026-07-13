<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\IzinOperasional;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikIzinOperasionalTable extends Migration
{
    protected $model = IzinOperasional::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_izin_operasional')->primary();
            $table->uuid('sekolah_id');
            $table->uuid('lembaga_id')->nullable();
            $table->string('sk_izin_operasional', 80);
            $table->date('tmt_izin_operasional');
            $table->decimal('masa_berlaku', 2, 0)->nullable();
            $table->date('tst_izin_operasional')->nullable();
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
}
