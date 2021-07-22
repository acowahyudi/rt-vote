<?php

namespace App\Repositories;

use App\Models\Penduduk;
use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class PendudukRepository
 * @package App\Repositories
 * @version June 1, 2021, 12:13 pm UTC
*/

class PendudukRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'tgl_lahir',
        'tempat_lahir',
        'agama'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
