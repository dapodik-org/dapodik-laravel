<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\TemplateRapor;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikTemplateRaporTable extends Migration
{
    protected $model = TemplateRapor::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('template_id');
            $table->bigInteger('mata_pelajaran_id');
            $table->decimal('no_urut', 3, 0);
            $table->primary(['template_id', 'mata_pelajaran_id']);
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
}
