<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\KesejahteraanPd;
use Illuminate\Database\Schema\Blueprint;

class AddAsalDataToKesejahteraanPdTable extends Migration
{
    protected $model = KesejahteraanPd::class;
    public function up(): void
    {
        $this->changeTable(function(Blueprint $table) {
            $table->char('asal_data', 1)->nullable()->after('sampai_tahun');
        });
    }

    public function down(): void
    {
        $this->dropColumns('asal_data');
    }
}
