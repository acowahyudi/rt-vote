<?php

namespace App\Repositories;

use App\Models\HasilVoting;
use App\Repositories\BaseRepository;

/**
 * Class HasilVotingRepository
 * @package App\Repositories
 * @version June 1, 2021, 12:14 pm UTC
*/

class HasilVotingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'periode_id',
        'penduduk_id',
        'kandidat_id'
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
        return HasilVoting::class;
    }
}
