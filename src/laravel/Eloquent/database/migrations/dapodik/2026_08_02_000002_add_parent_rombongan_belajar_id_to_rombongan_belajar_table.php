<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RombonganBelajar;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = RombonganBelajar::class;

    public function up()
    {
        $this->changeTable(function (Blueprint $table) {
            $table->uuid('parent_rombongan_belajar_id')->nullable();
        });
    }

    public function down()
    {
        $this->dropColumns('parent_rombongan_belajar_id');
    }
};
