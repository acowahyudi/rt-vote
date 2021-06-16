<?php namespace Tests\Repositories;

use App\Models\TingkatPendidikan;
use App\Repositories\TingkatPendidikanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TingkatPendidikanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TingkatPendidikanRepository
     */
    protected $tingkatPendidikanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tingkatPendidikanRepo = \App::make(TingkatPendidikanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tingkat_pendidikan()
    {
        $tingkatPendidikan = TingkatPendidikan::factory()->make()->toArray();

        $createdTingkatPendidikan = $this->tingkatPendidikanRepo->create($tingkatPendidikan);

        $createdTingkatPendidikan = $createdTingkatPendidikan->toArray();
        $this->assertArrayHasKey('id', $createdTingkatPendidikan);
        $this->assertNotNull($createdTingkatPendidikan['id'], 'Created TingkatPendidikan must have id specified');
        $this->assertNotNull(TingkatPendidikan::find($createdTingkatPendidikan['id']), 'TingkatPendidikan with given id must be in DB');
        $this->assertModelData($tingkatPendidikan, $createdTingkatPendidikan);
    }

    /**
     * @test read
     */
    public function test_read_tingkat_pendidikan()
    {
        $tingkatPendidikan = TingkatPendidikan::factory()->create();

        $dbTingkatPendidikan = $this->tingkatPendidikanRepo->find($tingkatPendidikan->id);

        $dbTingkatPendidikan = $dbTingkatPendidikan->toArray();
        $this->assertModelData($tingkatPendidikan->toArray(), $dbTingkatPendidikan);
    }

    /**
     * @test update
     */
    public function test_update_tingkat_pendidikan()
    {
        $tingkatPendidikan = TingkatPendidikan::factory()->create();
        $fakeTingkatPendidikan = TingkatPendidikan::factory()->make()->toArray();

        $updatedTingkatPendidikan = $this->tingkatPendidikanRepo->update($fakeTingkatPendidikan, $tingkatPendidikan->id);

        $this->assertModelData($fakeTingkatPendidikan, $updatedTingkatPendidikan->toArray());
        $dbTingkatPendidikan = $this->tingkatPendidikanRepo->find($tingkatPendidikan->id);
        $this->assertModelData($fakeTingkatPendidikan, $dbTingkatPendidikan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tingkat_pendidikan()
    {
        $tingkatPendidikan = TingkatPendidikan::factory()->create();

        $resp = $this->tingkatPendidikanRepo->delete($tingkatPendidikan->id);

        $this->assertTrue($resp);
        $this->assertNull(TingkatPendidikan::find($tingkatPendidikan->id), 'TingkatPendidikan should not exist in DB');
    }
}
