<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Author;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikAuthorTable extends Migration
{
    protected $model = Author::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_author')->primary();
            $table->string('nm_auhor', 100);
            $table->string('nm_alias1', 100)->nullable();
            $table->string('nm_alias2', 100)->nullable();
            $table->string('nm_alias3', 100)->nullable();
            $table->char('nik_author', 16)->nullable();
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
