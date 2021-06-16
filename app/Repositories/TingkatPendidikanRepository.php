<?php

namespace App\Repositories;

use App\Models\TingkatPendidikan;
use App\Repositories\BaseRepository;

/**
 * Class TingkatPendidikanRepository
 * @package App\Repositories
 * @version June 1, 2021, 12:13 pm UTC
*/

class TingkatPendidikanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pendidikan'
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
        return TingkatPendidikan::class;
    }
}
