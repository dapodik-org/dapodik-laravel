<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenjangKepengawasan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jenjang_kepengawasan_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'jenjang_kepengawasan_tk' => 'boolean',
            'jenjang_kepengawasan_sd' => 'boolean',
            'jenjang_kepengawasan_smp' => 'boolean',
            'jenjang_kepengawasan_sma' => 'boolean',
            'jenjang_kepengawasan_smk' => 'boolean',
            'jenjang_kepengawasan_slb' => 'boolean',
        ];
    }
}
