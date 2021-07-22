<?php namespace Tests\Repositories;

use App\Models\KegiatanRT;
use App\Repositories\KegiatanRTRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class KegiatanRTRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var KegiatanRTRepository
     */
    protected $kegiatanRTRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kegiatanRTRepo = \App::make(KegiatanRTRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kegiatan_r_t()
    {
        $kegiatanRT = KegiatanRT::factory()->make()->toArray();

        $createdKegiatanRT = $this->kegiatanRTRepo->create($kegiatanRT);

        $createdKegiatanRT = $createdKegiatanRT->toArray();
        $this->assertArrayHasKey('id', $createdKegiatanRT);
        $this->assertNotNull($createdKegiatanRT['id'], 'Created KegiatanRT must have id specified');
        $this->assertNotNull(KegiatanRT::find($createdKegiatanRT['id']), 'KegiatanRT with given id must be in DB');
        $this->assertModelData($kegiatanRT, $createdKegiatanRT);
    }

    /**
     * @test read
     */
    public function test_read_kegiatan_r_t()
    {
        $kegiatanRT = KegiatanRT::factory()->create();

        $dbKegiatanRT = $this->kegiatanRTRepo->find($kegiatanRT->id);

        $dbKegiatanRT = $dbKegiatanRT->toArray();
        $this->assertModelData($kegiatanRT->toArray(), $dbKegiatanRT);
    }

    /**
     * @test update
     */
    public function test_update_kegiatan_r_t()
    {
        $kegiatanRT = KegiatanRT::factory()->create();
        $fakeKegiatanRT = KegiatanRT::factory()->make()->toArray();

        $updatedKegiatanRT = $this->kegiatanRTRepo->update($fakeKegiatanRT, $kegiatanRT->id);

        $this->assertModelData($fakeKegiatanRT, $updatedKegiatanRT->toArray());
        $dbKegiatanRT = $this->kegiatanRTRepo->find($kegiatanRT->id);
        $this->assertModelData($fakeKegiatanRT, $dbKegiatanRT->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kegiatan_r_t()
    {
        $kegiatanRT = KegiatanRT::factory()->create();

        $resp = $this->kegiatanRTRepo->delete($kegiatanRT->id);

        $this->assertTrue($resp);
        $this->assertNull(KegiatanRT::find($kegiatanRT->id), 'KegiatanRT should not exist in DB');
    }
}
