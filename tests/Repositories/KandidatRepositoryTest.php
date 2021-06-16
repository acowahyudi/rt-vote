<?php namespace Tests\Repositories;

use App\Models\Kandidat;
use App\Repositories\KandidatRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class KandidatRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var KandidatRepository
     */
    protected $kandidatRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kandidatRepo = \App::make(KandidatRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kandidat()
    {
        $kandidat = Kandidat::factory()->make()->toArray();

        $createdKandidat = $this->kandidatRepo->create($kandidat);

        $createdKandidat = $createdKandidat->toArray();
        $this->assertArrayHasKey('id', $createdKandidat);
        $this->assertNotNull($createdKandidat['id'], 'Created Kandidat must have id specified');
        $this->assertNotNull(Kandidat::find($createdKandidat['id']), 'Kandidat with given id must be in DB');
        $this->assertModelData($kandidat, $createdKandidat);
    }

    /**
     * @test read
     */
    public function test_read_kandidat()
    {
        $kandidat = Kandidat::factory()->create();

        $dbKandidat = $this->kandidatRepo->find($kandidat->id);

        $dbKandidat = $dbKandidat->toArray();
        $this->assertModelData($kandidat->toArray(), $dbKandidat);
    }

    /**
     * @test update
     */
    public function test_update_kandidat()
    {
        $kandidat = Kandidat::factory()->create();
        $fakeKandidat = Kandidat::factory()->make()->toArray();

        $updatedKandidat = $this->kandidatRepo->update($fakeKandidat, $kandidat->id);

        $this->assertModelData($fakeKandidat, $updatedKandidat->toArray());
        $dbKandidat = $this->kandidatRepo->find($kandidat->id);
        $this->assertModelData($fakeKandidat, $dbKandidat->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kandidat()
    {
        $kandidat = Kandidat::factory()->create();

        $resp = $this->kandidatRepo->delete($kandidat->id);

        $this->assertTrue($resp);
        $this->assertNull(Kandidat::find($kandidat->id), 'Kandidat should not exist in DB');
    }
}
