<?php

namespace App\Repositories;

use App\Models\RukunTetangga;
use App\Repositories\BaseRepository;

/**
 * Class RukunTetanggaRepository
 * @package App\Repositories
 * @version July 7, 2021, 8:57 am UTC
*/

class RukunTetanggaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'rt',
        'kelurahan_id'
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
        return RukunTetangga::class;
    }
}
