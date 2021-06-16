<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TingkatPendidikan
 * @package App\Models
 * @version June 1, 2021, 12:13 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $kandidats
 * @property string $pendidikan
 */
class TingkatPendidikan extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'tingkat_pendidikan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'pendidikan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pendidikan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pendidikan' => 'nullable|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function kandidats()
    {
        return $this->hasMany(\App\Models\Kandidat::class, 'tingkat_pendidikan_id');
    }
}
