<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RombonganBelajar;
use Illuminate\Database\Schema\Blueprint;

class AddParentRombonganBelajarIdToRombonganBelajarTable extends Migration
{
    protected $model = RombonganBelajar::class;
    public function up(): void
    {
        $this->changeTable(function(Blueprint $table) {
            $table->uuid('parent_rombongan_belajar_id')->nullable()->after('kebutuhan_khusus_id');
        });
    }

    public function down(): void
    {
        $this->dropColumns('parent_rombongan_belajar_id');
    }
}
