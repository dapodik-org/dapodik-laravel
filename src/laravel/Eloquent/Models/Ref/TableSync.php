<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;

class TableSync extends Model
{
    use HasConnection;

    protected $primaryKey = 'table_name';

    public $incrementing = false;
}
