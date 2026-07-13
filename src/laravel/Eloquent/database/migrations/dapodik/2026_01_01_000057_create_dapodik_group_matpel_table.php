<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\GroupMatpel;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikGroupMatpelTable extends Migration
{
    protected $model = GroupMatpel::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('gmp_id')->primary();
            $table->string('nama_group', 80);
            $table->decimal('jumlah_jam_maksimum', 2, 0);
            $table->decimal('jumlah_sks_maksimum', 2, 0);
            $table->smallInteger('kurikulum_id');
            $table->decimal('tingkat_pendidikan_id', 2, 0);
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
