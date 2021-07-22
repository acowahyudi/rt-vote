<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Periode
 * @package App\Models
 * @version June 3, 2021, 6:49 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $hasilVotings
 * @property \Illuminate\Database\Eloquent\Collection $kandidats
 * @property string $tahun_mulai
 * @property string $tahun_selesai
 * @property string $mulai_vote
 * @property string $selesai_vote
 * @property string $keterangan
 */
class Periode extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'periode';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'mulai_vote',
        'selesai_vote',
        'rukun_tetangga_id',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'mulai_vote' => 'date',
        'selesai_vote' => 'date',
        'keterangan' => 'string',
        'rukun_tetangga_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'mulai_vote' => 'nullable',
        'selesai_vote' => 'nullable',
        'keterangan' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function hasilVotings()
    {
        return $this->hasMany(\App\Models\HasilVoting::class, 'periode_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function kandidats()
    {
        return $this->hasMany(\App\Models\Kandidat::class, 'periode_id');
    }

    public function rukunTetangga()
    {
        return $this->belongsTo(\App\Models\RukunTetangga::class, 'rukun_tetangga_id');
    }
}
