<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class HasilVoting
 * @package App\Models
 * @version June 1, 2021, 12:14 pm UTC
 *
 * @property \App\Models\Kandidat $kandidat
 * @property \App\Models\Penduduk $penduduk
 * @property \App\Models\Periode $periode
 * @property integer $periode_id
 * @property integer $penduduk_id
 * @property integer $kandidat_id
 */
class HasilVoting extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'hasil_voting';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'periode_id',
        'penduduk_id',
        'kandidat_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'periode_id' => 'integer',
        'penduduk_id' => 'integer',
        'kandidat_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'periode_id' => 'required|integer',
        'penduduk_id' => 'required|integer',
        'kandidat_id' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function kandidat()
    {
        return $this->belongsTo(\App\Models\Kandidat::class, 'kandidat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function penduduk()
    {
        return $this->belongsTo(\App\Models\Penduduk::class, 'penduduk_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function periode()
    {
        return $this->belongsTo(\App\Models\Periode::class, 'periode_id');
    }
}
