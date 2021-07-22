<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class KegiatanRT
 * @package App\Models
 * @version July 19, 2021, 9:41 am UTC
 *
 * @property \App\Models\RukunTetangga $rukunTetangga
 * @property string $title
 * @property string $foto
 * @property integer $rukun_tetangga_id
 */
class KegiatanRT extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kegiatan_rt';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'foto',
        'rukun_tetangga_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'foto' => 'string',
        'rukun_tetangga_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'nullable|string|max:255',
        'foto' => 'nullable',
        'rukun_tetangga_id' => 'integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function rukunTetangga()
    {
        return $this->belongsTo(\App\Models\RukunTetangga::class, 'rukun_tetangga_id');
    }
}
