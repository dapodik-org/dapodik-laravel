<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Publisher;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPublisherTable extends Migration
{
    protected $model = Publisher::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_publisher')->primary();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('head_office')->nullable();
            $table->string('director_name')->nullable();
            $table->string('director_phone')->nullable();
            $table->string('director_email')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('cp_phone')->nullable();
            $table->string('contact_person2')->nullable();
            $table->string('cp_phone2')->nullable();
            $table->string('npwp')->nullable();
            $table->string('siup')->nullable();
            $table->string('akta')->nullable();
            $table->string('no_kta')->nullable();
            $table->string('kta')->nullable();
            $table->string('surat')->nullable();
            $table->string('surat_pernyataan')->nullable();
            $table->string('kode_wilayah', 8);
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
