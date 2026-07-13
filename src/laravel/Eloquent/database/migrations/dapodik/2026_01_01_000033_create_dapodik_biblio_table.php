<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Biblio;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBiblioTable extends Migration
{
    protected $model = Biblio::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_biblio')->primary();
            $table->integer('id_freq')->nullable();
            $table->uuid('id_publisher')->nullable();
            $table->string('negara_id', 1);
            $table->string('id_gmd');
            $table->uuid('id_classification')->nullable();
            $table->string('title');
            $table->string('sor')->nullable();
            $table->string('edition')->nullable();
            $table->string('isbn_issn')->nullable();
            $table->string('collations');
            $table->string('publisher')->nullable();
            $table->string('publish_year')->nullable();
            $table->string('series_title')->nullable();
            $table->string('call_number')->nullable();
            $table->string('source')->nullable();
            $table->string('publish_place')->nullable();
            $table->string('notes')->nullable();
            $table->string('image')->nullable();
            $table->string('file_att')->nullable();
            $table->boolean('opac_hide')->nullable();
            $table->boolean('promoted')->nullable();
            $table->string('labels')->nullable();
            $table->string('paper_printing_spec')->nullable();
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
