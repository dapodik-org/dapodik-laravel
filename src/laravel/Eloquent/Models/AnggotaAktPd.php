<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnggotaAktPd extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_ang_akt_pd';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.anggota_akt_pd → public.registrasi_peserta_didik (registrasi_id → registrasi_id).
     */
    public function registrasi(): BelongsTo
    {
        return $this->belongsTo(RegistrasiPesertaDidik::class, 'registrasi_id', 'registrasi_id');
    }

    /**
     * public.anggota_akt_pd → public.akt_pd (id_akt_pd → id_akt_pd).
     */
    public function aktPd(): BelongsTo
    {
        return $this->belongsTo(AktPd::class, 'id_akt_pd', 'id_akt_pd');
    }
}
