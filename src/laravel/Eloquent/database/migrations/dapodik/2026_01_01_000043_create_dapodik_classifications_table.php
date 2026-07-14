<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Classifications;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Classifications::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_classification')->primary();
            $table->uuid('id_classification_parent')->nullable();
            $table->string('classification_name')->nullable();
            $table->string('parent_path')->nullable();
            $table->integer('assessment_template_id')->default(1);
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
