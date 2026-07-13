<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstWilayah extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'kode_wilayah';

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'a_desa' => 'boolean',
            'a_kelurahan' => 'boolean',
            'a_35' => 'boolean',
            'a_urban' => 'boolean',
        ];
    }

    /**
     * ref.mst_wilayah → ref.kategori_desa (kategori_desa_id → kategori_desa_id).
     */
    public function kategoriDesa(): BelongsTo
    {
        return $this->belongsTo(KategoriDesa::class, 'kategori_desa_id', 'kategori_desa_id');
    }

    /**
     * ref.mst_wilayah → ref.level_wilayah (id_level_wilayah → id_level_wilayah).
     */
    public function levelWilayah(): BelongsTo
    {
        return $this->belongsTo(LevelWilayah::class, 'id_level_wilayah', 'id_level_wilayah');
    }

    /**
     * ref.mst_wilayah → ref.negara (negara_id → negara_id).
     */
    public function negara(): BelongsTo
    {
        return $this->belongsTo(Negara::class, 'negara_id', 'negara_id');
    }

    /**
     * ref.mst_wilayah ← ref.lemb_sertifikasi (kode_wilayah → kode_wilayah).
     */
    public function lembSertifikasis(): HasMany
    {
        return $this->hasMany(LembSertifikasi::class, 'kode_wilayah', 'kode_wilayah');
    }

    /**
     * ref.mst_wilayah ← ref.lembaga_akreditasi (kode_wilayah → kode_wilayah).
     */
    public function lembagaAkreditasis(): HasMany
    {
        return $this->hasMany(LembagaAkreditasi::class, 'kode_wilayah', 'kode_wilayah');
    }

    /**
     * ref.mst_wilayah ← ref.mulok (kode_wilayah → kode_wilayah).
     */
    public function muloks(): HasMany
    {
        return $this->hasMany(Mulok::class, 'kode_wilayah', 'kode_wilayah');
    }

    /**
     * ref.mst_wilayah ← ref.tetangga_kabkota (kode_wilayah → kode_wilayah1).
     */
    public function tetanggaKabkotas(): HasMany
    {
        return $this->hasMany(TetanggaKabkota::class, 'kode_wilayah1', 'kode_wilayah');
    }

    /**
     * ref.mst_wilayah → ref.kategori_desa (kategori_desa_id → kategori_desa_id).
     */

    /**
     * ref.mst_wilayah → ref.level_wilayah (id_level_wilayah → id_level_wilayah).
     */

    /**
     * ref.mst_wilayah → ref.mst_wilayah (mst_kode_wilayah → kode_wilayah).
     */
    public function mstKodeWilayah(): BelongsTo
    {
        return $this->belongsTo(self::class, 'mst_kode_wilayah', 'kode_wilayah');
    }

    /**
     * ref.mst_wilayah → ref.negara (negara_id → negara_id).
     */

    /**
     * ref.mst_wilayah ← ref.lemb_sertifikasi (kode_wilayah → kode_wilayah).
     */

    /**
     * ref.mst_wilayah ← ref.lembaga_akreditasi (kode_wilayah → kode_wilayah).
     */

    /**
     * ref.mst_wilayah ← ref.mst_wilayah (kode_wilayah → mst_kode_wilayah).
     */
    public function mstWilayahs(): HasMany
    {
        return $this->hasMany(self::class, 'mst_kode_wilayah', 'kode_wilayah');
    }

    /*
     * ref.mst_wilayah ← ref.mulok (kode_wilayah → kode_wilayah)
     */

    /*
     * ref.mst_wilayah ← ref.tetangga_kabkota (kode_wilayah → kode_wilayah1)
     */
}
