<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\PemakaiSarana;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = PemakaiSarana::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenis_sarana_id');
            $table->char('jurusan_id', 25);
            $table->primary(['jenis_sarana_id', 'jurusan_id']);
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
