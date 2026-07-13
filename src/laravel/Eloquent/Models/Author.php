<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'expired_date';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_author';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }
}
