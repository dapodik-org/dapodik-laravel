<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKesejahteraan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KesejahteraanPd extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_sejahtera_pd';

    protected function casts(): array
    {
        return [
            'asal_data' => 'string',
            'dari_tahun' => 'decimal',
            'sampai_tahun' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.kesejahteraan_pd → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.kesejahteraan_pd → ref.jenis_kesejahteraan (jenis_kesejahteraan_id → jenis_kesejahteraan_id).
     */
    public function jenisKesejahteraan(): BelongsTo
    {
        return $this->belongsTo(JenisKesejahteraan::class, 'jenis_kesejahteraan_id', 'jenis_kesejahteraan_id');
    }
}
