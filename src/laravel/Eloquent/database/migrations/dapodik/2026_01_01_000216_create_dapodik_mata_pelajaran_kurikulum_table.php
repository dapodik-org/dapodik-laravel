<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\MataPelajaranKurikulum;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikMataPelajaranKurikulumTable extends Migration
{
    protected $model = MataPelajaranKurikulum::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('kurikulum_id');
            $table->bigInteger('mata_pelajaran_id');
            $table->bigInteger('tingkat_pendidikan_id');
            $table->decimal('jumlah_jam', 2, 0);
            $table->decimal('jumlah_jam_maksimum', 2, 0);
            $table->bigInteger('status_di_kurikulum');
            $table->decimal('wajib', 1, 0);
            $table->decimal('sks', 2, 0)->default(0);
            $table->boolean('a_peminatan');
            $table->char('area_kompetensi', 1);
            $table->uuid('gmp_id')->nullable();
            $table->primary(['kurikulum_id', 'mata_pelajaran_id', 'tingkat_pendidikan_id'], 'pk_mata_pelajaran_kurikulum');
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
