<?php namespace Tests\Repositories;

use App\Models\Penduduk;
use App\Repositories\PendudukRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PendudukRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PendudukRepository
     */
    protected $pendudukRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pendudukRepo = \App::make(PendudukRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_penduduk()
    {
        $penduduk = Penduduk::factory()->make()->toArray();

        $createdPenduduk = $this->pendudukRepo->create($penduduk);

        $createdPenduduk = $createdPenduduk->toArray();
        $this->assertArrayHasKey('id', $createdPenduduk);
        $this->assertNotNull($createdPenduduk['id'], 'Created Penduduk must have id specified');
        $this->assertNotNull(Penduduk::find($createdPenduduk['id']), 'Penduduk with given id must be in DB');
        $this->assertModelData($penduduk, $createdPenduduk);
    }

    /**
     * @test read
     */
    public function test_read_penduduk()
    {
        $penduduk = Penduduk::factory()->create();

        $dbPenduduk = $this->pendudukRepo->find($penduduk->id);

        $dbPenduduk = $dbPenduduk->toArray();
        $this->assertModelData($penduduk->toArray(), $dbPenduduk);
    }

    /**
     * @test update
     */
    public function test_update_penduduk()
    {
        $penduduk = Penduduk::factory()->create();
        $fakePenduduk = Penduduk::factory()->make()->toArray();

        $updatedPenduduk = $this->pendudukRepo->update($fakePenduduk, $penduduk->id);

        $this->assertModelData($fakePenduduk, $updatedPenduduk->toArray());
        $dbPenduduk = $this->pendudukRepo->find($penduduk->id);
        $this->assertModelData($fakePenduduk, $dbPenduduk->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_penduduk()
    {
        $penduduk = Penduduk::factory()->create();

        $resp = $this->pendudukRepo->delete($penduduk->id);

        $this->assertTrue($resp);
        $this->assertNull(Penduduk::find($penduduk->id), 'Penduduk should not exist in DB');
    }
}
