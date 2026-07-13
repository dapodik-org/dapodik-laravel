<?php

namespace Dapodik\Laravel\Eloquent\Models\Pustaka;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biblio extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_biblio';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * pustaka.biblio → pustaka.classifications (id_classification → id_classification).
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classifications::class, 'id_classification', 'id_classification');
    }

    /**
     * pustaka.biblio → pustaka.frequency (id_freq → id_freq).
     */
    public function freq(): BelongsTo
    {
        return $this->belongsTo(Frequency::class, 'id_freq', 'id_freq');
    }

    /**
     * pustaka.biblio → pustaka.gmd (id_gmd → id_gmd).
     */
    public function gmd(): BelongsTo
    {
        return $this->belongsTo(Gmd::class, 'id_gmd', 'id_gmd');
    }

    /**
     * pustaka.biblio → pustaka.publisher (id_publisher → id_publisher).
     */
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'id_publisher', 'id_publisher');
    }

    /**
     * pustaka.biblio ← pustaka.daftar_author (id_biblio → id_biblio).
     */
    public function daftarAuthors(): HasMany
    {
        return $this->hasMany(DaftarAuthor::class, 'id_biblio', 'id_biblio');
    }

    /**
     * pustaka.biblio ← pustaka.mapel_biblio (id_biblio → id_biblio).
     */
    public function mapelBiblios(): HasMany
    {
        return $this->hasMany(MapelBiblio::class, 'id_biblio', 'id_biblio');
    }

    /**
     * pustaka.biblio ← pustaka.tingkat_biblio (id_biblio → id_biblio).
     */
    public function tingkatBiblios(): HasMany
    {
        return $this->hasMany(TingkatBiblio::class, 'id_biblio', 'id_biblio');
    }
}
