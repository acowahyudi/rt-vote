<?php

namespace App\Repositories;

use App\Models\KegiatanRT;
use App\Repositories\BaseRepository;

/**
 * Class KegiatanRTRepository
 * @package App\Repositories
 * @version July 19, 2021, 9:41 am UTC
*/

class KegiatanRTRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'foto',
        'rukun_tetangga_id'
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
        return KegiatanRT::class;
    }
}
