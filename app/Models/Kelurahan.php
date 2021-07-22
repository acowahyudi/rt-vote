<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Kelurahan
 * @package App\Models
 * @version July 7, 2021, 8:57 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $rukunTetanggas
 * @property string $kelurahan
 * @property string $kecamatan
 */
class Kelurahan extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kelurahan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'kelurahan',
        'kecamatan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kelurahan' => 'string',
        'kecamatan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kelurahan' => 'nullable|string|max:255',
        'kecamatan' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rukunTetanggas()
    {
        return $this->hasMany(\App\Models\RukunTetangga::class, 'kelurahan_id');
    }
}
