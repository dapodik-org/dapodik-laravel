<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisFlag;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JenisFlag::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->integer('jenis_flag_id')->primary();
            $table->string('jenis_flag', 30);
            $table->boolean('untuk_sekolah');
            $table->boolean('untuk_peserta_didik');
            $table->boolean('untuk_ptk');
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
