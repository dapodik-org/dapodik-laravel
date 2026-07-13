<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_bank';

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }
}
