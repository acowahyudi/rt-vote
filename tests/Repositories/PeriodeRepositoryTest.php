<?php namespace Tests\Repositories;

use App\Models\Periode;
use App\Repositories\PeriodeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PeriodeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PeriodeRepository
     */
    protected $periodeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->periodeRepo = \App::make(PeriodeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_periode()
    {
        $periode = Periode::factory()->make()->toArray();

        $createdPeriode = $this->periodeRepo->create($periode);

        $createdPeriode = $createdPeriode->toArray();
        $this->assertArrayHasKey('id', $createdPeriode);
        $this->assertNotNull($createdPeriode['id'], 'Created Periode must have id specified');
        $this->assertNotNull(Periode::find($createdPeriode['id']), 'Periode with given id must be in DB');
        $this->assertModelData($periode, $createdPeriode);
    }

    /**
     * @test read
     */
    public function test_read_periode()
    {
        $periode = Periode::factory()->create();

        $dbPeriode = $this->periodeRepo->find($periode->id);

        $dbPeriode = $dbPeriode->toArray();
        $this->assertModelData($periode->toArray(), $dbPeriode);
    }

    /**
     * @test update
     */
    public function test_update_periode()
    {
        $periode = Periode::factory()->create();
        $fakePeriode = Periode::factory()->make()->toArray();

        $updatedPeriode = $this->periodeRepo->update($fakePeriode, $periode->id);

        $this->assertModelData($fakePeriode, $updatedPeriode->toArray());
        $dbPeriode = $this->periodeRepo->find($periode->id);
        $this->assertModelData($fakePeriode, $dbPeriode->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_periode()
    {
        $periode = Periode::factory()->create();

        $resp = $this->periodeRepo->delete($periode->id);

        $this->assertTrue($resp);
        $this->assertNull(Periode::find($periode->id), 'Periode should not exist in DB');
    }
}
