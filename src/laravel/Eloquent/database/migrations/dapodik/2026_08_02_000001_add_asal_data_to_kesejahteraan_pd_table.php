<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\KesejahteraanPd;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = KesejahteraanPd::class;

    public function up()
    {
        $this->changeTable(function (Blueprint $table) {
            $table->char('asal_data', 1)->nullable();
        });
    }

    public function down()
    {
        $this->dropColumns('asal_data');
    }
};
