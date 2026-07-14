<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\ManAkses\MenuRole;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = MenuRole::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_menu');
            $table->integer('peran_id');
            $table->string('akses_menu')->nullable();
            $table->boolean('a_boleh_insert')->nullable();
            $table->boolean('a_boleh_delete')->nullable();
            $table->boolean('a_boleh_update')->nullable();
            $table->boolean('a_boleh_sanggah')->nullable();
            $table->boolean('approval_menu');
            $table->primary(['id_menu', 'peran_id']);
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
