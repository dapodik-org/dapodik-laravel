<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StandarSarana extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_std_sarana';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'a_harus_ada' => 'boolean',
        ];
    }

    /**
     * ref.standar_sarana → ref.jenis_sarana (jenis_sarana_id → jenis_sarana_id).
     */
    public function jenisSarana(): BelongsTo
    {
        return $this->belongsTo(JenisSarana::class, 'jenis_sarana_id', 'jenis_sarana_id');
    }

    /**
     * ref.standar_sarana → ref.bentuk_pendidikan (bentuk_pendidikan_id → bentuk_pendidikan_id).
     */
    public function bentukPendidikan(): BelongsTo
    {
        return $this->belongsTo(BentukPendidikan::class, 'bentuk_pendidikan_id', 'bentuk_pendidikan_id');
    }

    /**
     * ref.standar_sarana → ref.jenis_prasarana (jenis_prasarana_id → jenis_prasarana_id).
     */
    public function jenisPrasarana(): BelongsTo
    {
        return $this->belongsTo(JenisPrasarana::class, 'jenis_prasarana_id', 'jenis_prasarana_id');
    }

    /**
     * ref.standar_sarana → ref.jurusan (jurusan_id → jurusan_id).
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }
}
