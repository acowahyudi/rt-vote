<?php namespace Tests\Repositories;

use App\Models\RukunTetangga;
use App\Repositories\RukunTetanggaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RukunTetanggaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RukunTetanggaRepository
     */
    protected $rukunTetanggaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rukunTetanggaRepo = \App::make(RukunTetanggaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rukun_tetangga()
    {
        $rukunTetangga = RukunTetangga::factory()->make()->toArray();

        $createdRukunTetangga = $this->rukunTetanggaRepo->create($rukunTetangga);

        $createdRukunTetangga = $createdRukunTetangga->toArray();
        $this->assertArrayHasKey('id', $createdRukunTetangga);
        $this->assertNotNull($createdRukunTetangga['id'], 'Created RukunTetangga must have id specified');
        $this->assertNotNull(RukunTetangga::find($createdRukunTetangga['id']), 'RukunTetangga with given id must be in DB');
        $this->assertModelData($rukunTetangga, $createdRukunTetangga);
    }

    /**
     * @test read
     */
    public function test_read_rukun_tetangga()
    {
        $rukunTetangga = RukunTetangga::factory()->create();

        $dbRukunTetangga = $this->rukunTetanggaRepo->find($rukunTetangga->id);

        $dbRukunTetangga = $dbRukunTetangga->toArray();
        $this->assertModelData($rukunTetangga->toArray(), $dbRukunTetangga);
    }

    /**
     * @test update
     */
    public function test_update_rukun_tetangga()
    {
        $rukunTetangga = RukunTetangga::factory()->create();
        $fakeRukunTetangga = RukunTetangga::factory()->make()->toArray();

        $updatedRukunTetangga = $this->rukunTetanggaRepo->update($fakeRukunTetangga, $rukunTetangga->id);

        $this->assertModelData($fakeRukunTetangga, $updatedRukunTetangga->toArray());
        $dbRukunTetangga = $this->rukunTetanggaRepo->find($rukunTetangga->id);
        $this->assertModelData($fakeRukunTetangga, $dbRukunTetangga->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rukun_tetangga()
    {
        $rukunTetangga = RukunTetangga::factory()->create();

        $resp = $this->rukunTetanggaRepo->delete($rukunTetangga->id);

        $this->assertTrue($resp);
        $this->assertNull(RukunTetangga::find($rukunTetangga->id), 'RukunTetangga should not exist in DB');
    }
}
