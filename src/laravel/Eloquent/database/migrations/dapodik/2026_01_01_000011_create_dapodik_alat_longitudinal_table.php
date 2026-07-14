<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AlatLongitudinal;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = AlatLongitudinal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_alat');
            $table->char('semester_id', 5);
            $table->primary(['id_alat', 'semester_id']);
            $table->integer('jumlah');
            $table->integer('jumlah_laik');
            $table->decimal('status_kelaikan', 1, 0);
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
