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
            $table->string('jenis_flag', 50);
            $table->decimal('untuk_sekolah')->default(0);
            $table->decimal('untuk_peserta_didik')->default(0);
            $table->decimal('untuk_ptk')->default(0);
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
