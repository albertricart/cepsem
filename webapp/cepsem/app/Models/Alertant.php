<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alertant extends Model
{
    use HasFactory;

    protected $table = "alertants";
    public $timestamps = false;
    protected $fillable = ['telefon', 'nom', 'cognoms', 'adreca', 'municipis_id', 'tipus_alertants_id'];

    /**
     * Get all of the incidencies for the Alertant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencies()
    {
        return $this->hasMany(Incidencia::class, 'alertants_id');
    }
}
