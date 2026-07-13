<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuangLongitudinal extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['id_ruang', 'semester_id'];

    protected function casts(): array
    {
        return [
            'nilai_kerusakan' => 'decimal',
            'rusak_lisplang_talang' => 'decimal',
            'rusak_rangka_plafon' => 'decimal',
            'rusak_tutup_plafon' => 'decimal',
            'rusak_bata_dinding' => 'decimal',
            'rusak_plester_dinding' => 'decimal',
            'rusak_daun_jendela' => 'decimal',
            'rusak_daun_pintu' => 'decimal',
            'rusak_kusen' => 'decimal',
            'rusak_tutup_lantai' => 'decimal',
            'rusak_inst_listrik' => 'decimal',
            'rusak_inst_air' => 'decimal',
            'rusak_drainase' => 'decimal',
            'rusak_finish_struktur' => 'decimal',
            'rusak_finish_plafon' => 'decimal',
            'rusak_finish_dinding' => 'decimal',
            'rusak_finish_kpj' => 'decimal',
            'berfungsi' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.ruang_longitudinal → public.ruang (id_ruang → id_ruang).
     */
    public function ruang(): BelongsTo
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id_ruang');
    }
}
