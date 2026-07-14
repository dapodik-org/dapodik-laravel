<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pustaka\DaftarAuthor;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikDaftarAuthorTable extends Migration
{
    protected $model = DaftarAuthor::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_biblio');
            $table->integer('urutan_author');
            $table->uuid('id_author');
            $table->integer('peran_biblio')->default(1);
            $table->primary(['id_biblio', 'urutan_author']);
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
