<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\KebutuhanKhusus;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikKebutuhanKhususTable extends Migration
{
    protected $model = KebutuhanKhusus::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('kebutuhan_khusus_id')->primary();
            $table->string('kebutuhan_khusus');
            $table->boolean('kk_a');
            $table->boolean('kk_b');
            $table->boolean('kk_c');
            $table->boolean('kk_c1');
            $table->boolean('kk_d');
            $table->boolean('kk_d1');
            $table->boolean('kk_e');
            $table->boolean('kk_f');
            $table->boolean('kk_h');
            $table->boolean('kk_i');
            $table->boolean('kk_j');
            $table->boolean('kk_k');
            $table->boolean('kk_n');
            $table->boolean('kk_o');
            $table->boolean('kk_p');
            $table->boolean('kk_q');
            $table->boolean('untuk_lembaga')->default(true);
            $table->boolean('untuk_ptk')->default(true);
            $table->boolean('untuk_pd')->default(true);
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
