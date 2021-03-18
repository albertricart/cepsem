<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuari extends Model
{
    use HasFactory;

    protected $table = "usuaris";
    protected $timestamps = false;

    /**
     * Get all of the incidencies for the Usuari
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencies()
    {
        return $this->hasMany(Incidencia::class, 'usuaris_id');
    }

    /**
     * Get the recurs that owns the Usuari
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recurs()
    {
        return $this->belongsTo(Recurs::class, 'recursos_id');
    }

    /**
     * Get the rol that owns the Usuari
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rols_id');
    }
}
