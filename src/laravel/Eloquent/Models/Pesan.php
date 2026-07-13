<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'expired_date';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'pesan_id';

    protected function casts(): array
    {
        return [
            'status_pesan' => 'integer',
        ];
    }
}
