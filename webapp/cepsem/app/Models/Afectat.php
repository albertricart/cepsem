<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afectat extends Model
{
    use HasFactory;

    protected $table = "afectats";
    protected $timestamps = false;

    /**
     * Get the sexe that owns the Afectat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sexe()
    {
        return $this->belongsTo(Sexe::class, 'sexes_id');
    }


    /**
     * The incidencies that belong to the Afectat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function incidencies()
    {
        return $this->belongsToMany(Incidencia::class, 'incidencies_has_afectats', 'afectats_id', 'incidencies_id');
    }
}
