<?php

namespace App\Repositories;

use App\Models\Kelurahan;
use App\Repositories\BaseRepository;

/**
 * Class KelurahanRepository
 * @package App\Repositories
 * @version July 7, 2021, 8:57 am UTC
*/

class KelurahanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'kelurahan',
        'kecamatan'
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
        return Kelurahan::class;
    }
}
