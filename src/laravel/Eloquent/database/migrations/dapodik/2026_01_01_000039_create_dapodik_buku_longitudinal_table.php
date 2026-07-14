<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\BukuLongitudinal;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBukuLongitudinalTable extends Migration
{
    protected $model = BukuLongitudinal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_buku');
            $table->char('semester_id', 5);
            $table->primary(['id_buku', 'semester_id']);
            $table->integer('jumlah');
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
}
