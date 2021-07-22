<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RukunTetangga
 * @package App\Models
 * @version July 7, 2021, 8:57 am UTC
 *
 * @property \App\Models\Kelurahan $kelurahan
 * @property \Illuminate\Database\Eloquent\Collection $periodes
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property string $rt
 * @property integer $kelurahan_id
 */
class RukunTetangga extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rukun_tetangga';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'rt',
        'kelurahan_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'rt' => 'string',
        'kelurahan_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rt' => 'nullable|string|max:45',
        'kelurahan_id' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function kelurahan()
    {
        return $this->belongsTo(\App\Models\Kelurahan::class, 'kelurahan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function periodes()
    {
        return $this->hasMany(\App\Models\Periode::class, 'rukun_tetangga_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'rukun_tetangga_id');
    }
}
