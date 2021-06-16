<?php

namespace App\Repositories;

use App\Models\Periode;
use App\Repositories\BaseRepository;

/**
 * Class PeriodeRepository
 * @package App\Repositories
 * @version June 3, 2021, 6:49 am UTC
*/

class PeriodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tahun_mulai',
        'tahun_selesai',
        'mulai_vote',
        'selesai_vote',
        'keterangan'
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
        return Periode::class;
    }
}
