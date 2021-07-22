<?php namespace Tests\Repositories;

use App\Models\Kelurahan;
use App\Repositories\KelurahanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class KelurahanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var KelurahanRepository
     */
    protected $kelurahanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kelurahanRepo = \App::make(KelurahanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kelurahan()
    {
        $kelurahan = Kelurahan::factory()->make()->toArray();

        $createdKelurahan = $this->kelurahanRepo->create($kelurahan);

        $createdKelurahan = $createdKelurahan->toArray();
        $this->assertArrayHasKey('id', $createdKelurahan);
        $this->assertNotNull($createdKelurahan['id'], 'Created Kelurahan must have id specified');
        $this->assertNotNull(Kelurahan::find($createdKelurahan['id']), 'Kelurahan with given id must be in DB');
        $this->assertModelData($kelurahan, $createdKelurahan);
    }

    /**
     * @test read
     */
    public function test_read_kelurahan()
    {
        $kelurahan = Kelurahan::factory()->create();

        $dbKelurahan = $this->kelurahanRepo->find($kelurahan->id);

        $dbKelurahan = $dbKelurahan->toArray();
        $this->assertModelData($kelurahan->toArray(), $dbKelurahan);
    }

    /**
     * @test update
     */
    public function test_update_kelurahan()
    {
        $kelurahan = Kelurahan::factory()->create();
        $fakeKelurahan = Kelurahan::factory()->make()->toArray();

        $updatedKelurahan = $this->kelurahanRepo->update($fakeKelurahan, $kelurahan->id);

        $this->assertModelData($fakeKelurahan, $updatedKelurahan->toArray());
        $dbKelurahan = $this->kelurahanRepo->find($kelurahan->id);
        $this->assertModelData($fakeKelurahan, $dbKelurahan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kelurahan()
    {
        $kelurahan = Kelurahan::factory()->create();

        $resp = $this->kelurahanRepo->delete($kelurahan->id);

        $this->assertTrue($resp);
        $this->assertNull(Kelurahan::find($kelurahan->id), 'Kelurahan should not exist in DB');
    }
}
