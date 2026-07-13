<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AktPd extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_akt_pd';

    protected function casts(): array
    {
        return [
            'id_jns_akt_pd' => 'decimal',
            'tgl_sk_tugas' => 'date',
            'a_komunal' => 'decimal',
            'tgl_mulai' => 'date',
            'tgl_selesai' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.akt_pd → public.mou (mou_id → mou_id).
     */
    public function mou(): BelongsTo
    {
        return $this->belongsTo(Mou::class, 'mou_id', 'mou_id');
    }

    /**
     * public.akt_pd ← public.anggota_akt_pd (id_akt_pd → id_akt_pd).
     */
    public function anggotaAktPds(): HasMany
    {
        return $this->hasMany(AnggotaAktPd::class, 'id_akt_pd', 'id_akt_pd');
    }

    /**
     * public.akt_pd ← public.bimbing_pd (id_akt_pd → id_akt_pd).
     */
    public function bimbingPds(): HasMany
    {
        return $this->hasMany(BimbingPd::class, 'id_akt_pd', 'id_akt_pd');
    }

    /**
     * public.akt_pd ← public.vld_akt_pd (id_akt_pd → id_akt_pd).
     */
    public function vldAktPds(): HasMany
    {
        return $this->hasMany(VldAktPd::class, 'id_akt_pd', 'id_akt_pd');
    }
}
