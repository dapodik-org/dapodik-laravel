<?php

namespace Dapodik\Laravel\Eloquent\Models\Audit;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;

class LoggedActions extends Model
{
    use HasConnection;

    public $timestamps = false;

    protected $primaryKey = 'event_id';
}
