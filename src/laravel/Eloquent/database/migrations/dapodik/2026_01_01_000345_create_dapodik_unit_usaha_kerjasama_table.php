<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\UnitUsahaKerjasama;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikUnitUsahaKerjasamaTable extends Migration
{
    protected $model = UnitUsahaKerjasama::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('mou_id');
            $table->uuid('unit_usaha_id');
            $table->primary(['mou_id', 'unit_usaha_id']);
            $table->decimal('sumber_dana_id', 3, 0);
            $table->string('produk_barang_dihasilkan', 200)->nullable();
            $table->string('jasa_produksi_dihasilkan', 200)->nullable();
            $table->decimal('omzet_barang_perbulan', 18, 0)->nullable();
            $table->decimal('omzet_jasa_perbulan', 18, 0)->nullable();
            $table->string('prestasi_penghargaan', 200)->nullable();
            $table->string('pangsa_pasar_produk', 200)->nullable();
            $table->string('pangsa_pasar_jasa', 200)->nullable();
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
