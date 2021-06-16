<?php namespace Tests\Repositories;

use App\Models\HasilVoting;
use App\Repositories\HasilVotingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class HasilVotingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var HasilVotingRepository
     */
    protected $hasilVotingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hasilVotingRepo = \App::make(HasilVotingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hasil_voting()
    {
        $hasilVoting = HasilVoting::factory()->make()->toArray();

        $createdHasilVoting = $this->hasilVotingRepo->create($hasilVoting);

        $createdHasilVoting = $createdHasilVoting->toArray();
        $this->assertArrayHasKey('id', $createdHasilVoting);
        $this->assertNotNull($createdHasilVoting['id'], 'Created HasilVoting must have id specified');
        $this->assertNotNull(HasilVoting::find($createdHasilVoting['id']), 'HasilVoting with given id must be in DB');
        $this->assertModelData($hasilVoting, $createdHasilVoting);
    }

    /**
     * @test read
     */
    public function test_read_hasil_voting()
    {
        $hasilVoting = HasilVoting::factory()->create();

        $dbHasilVoting = $this->hasilVotingRepo->find($hasilVoting->id);

        $dbHasilVoting = $dbHasilVoting->toArray();
        $this->assertModelData($hasilVoting->toArray(), $dbHasilVoting);
    }

    /**
     * @test update
     */
    public function test_update_hasil_voting()
    {
        $hasilVoting = HasilVoting::factory()->create();
        $fakeHasilVoting = HasilVoting::factory()->make()->toArray();

        $updatedHasilVoting = $this->hasilVotingRepo->update($fakeHasilVoting, $hasilVoting->id);

        $this->assertModelData($fakeHasilVoting, $updatedHasilVoting->toArray());
        $dbHasilVoting = $this->hasilVotingRepo->find($hasilVoting->id);
        $this->assertModelData($fakeHasilVoting, $dbHasilVoting->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hasil_voting()
    {
        $hasilVoting = HasilVoting::factory()->create();

        $resp = $this->hasilVotingRepo->delete($hasilVoting->id);

        $this->assertTrue($resp);
        $this->assertNull(HasilVoting::find($hasilVoting->id), 'HasilVoting should not exist in DB');
    }
}
