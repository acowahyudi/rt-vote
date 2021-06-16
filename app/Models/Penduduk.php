<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Penduduk
 * @package App\Models
 * @version June 1, 2021, 12:13 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $hasilVotings
 * @property string $nama
 * @property string $nik
 * @property string $jenis_kelamin
 * @property string $tgl_lahir
 * @property string $tempat_lahir
 * @property string $agama
 */
class Penduduk extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'penduduk';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'tgl_lahir',
        'tempat_lahir',
        'agama'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'nik' => 'string',
        'jenis_kelamin' => 'string',
        'tgl_lahir' => 'date',
        'tempat_lahir' => 'string',
        'agama' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'nullable|string|max:255',
        'nik' => 'nullable|string|max:255',
        'jenis_kelamin' => 'nullable|string|max:1',
        'tgl_lahir' => 'nullable',
        'tempat_lahir' => 'nullable|string|max:255',
        'agama' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function hasilVotings()
    {
        return $this->hasMany(\App\Models\HasilVoting::class, 'penduduk_id');
    }


}
