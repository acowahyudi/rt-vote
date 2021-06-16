<?php

namespace App\Repositories;

use App\Models\Kandidat;
use App\Repositories\BaseRepository;

/**
 * Class KandidatRepository
 * @package App\Repositories
 * @version June 1, 2021, 12:13 pm UTC
*/

class KandidatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'no_calon',
        'nama',
        'tgl_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'agama',
        'foto',
        'visi',
        'tingkat_pendidikan_id',
        'periode_id'
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
        return Kandidat::class;
    }
}
