<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Kandidat
 * @package App\Models
 * @version June 1, 2021, 12:13 pm UTC
 *
 * @property \App\Models\Periode $periode
 * @property \App\Models\TingkatPendidikan $tingkatPendidikan
 * @property \Illuminate\Database\Eloquent\Collection $hasilVotings
 * @property integer $no_calon
 * @property string $nama
 * @property string $tgl_lahir
 * @property string $tempat_lahir
 * @property string $jenis_kelamin
 * @property string $agama
 * @property string $foto
 * @property string $visi
 * @property integer $tingkat_pendidikan_id
 * @property integer $periode_id
 */
class Kandidat extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kandidat';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $appends = [
        'vote_count',
    ];

    public $fillable = [
        'no_calon',
        'nama',
        'foto',
        'visi',
        'periode_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'no_calon' => 'integer',
        'nama' => 'string',
        'foto' => 'string',
        'visi' => 'string',
        'periode_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'no_calon' => 'nullable|integer',
        'nama' => 'nullable|string|max:255',
        'visi' => 'nullable|string',
        'periode_id' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function periode()
    {
        return $this->belongsTo(\App\Models\Periode::class, 'periode_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function hasilVotings()
    {
        return $this->hasMany(\App\Models\HasilVoting::class, 'kandidat_id');
    }

    public function getVoteCountAttribute()
    {
        return $this->hasilVotings()->count();
    }
}
