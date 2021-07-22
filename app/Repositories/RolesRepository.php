<?php

namespace App\Repositories;

use App\Models\Roles;
use App\Repositories\BaseRepository;

/**
 * Class RolesRepository
 * @package App\Repositories
 * @version July 19, 2021, 9:41 am UTC
*/

class RolesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role'
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
        return Roles::class;
    }
}
