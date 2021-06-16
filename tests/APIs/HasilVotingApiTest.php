<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\HasilVoting;

class HasilVotingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hasil_voting()
    {
        $hasilVoting = HasilVoting::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/hasil_votings', $hasilVoting
        );

        $this->assertApiResponse($hasilVoting);
    }

    /**
     * @test
     */
    public function test_read_hasil_voting()
    {
        $hasilVoting = HasilVoting::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/hasil_votings/'.$hasilVoting->id
        );

        $this->assertApiResponse($hasilVoting->toArray());
    }

    /**
     * @test
     */
    public function test_update_hasil_voting()
    {
        $hasilVoting = HasilVoting::factory()->create();
        $editedHasilVoting = HasilVoting::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/hasil_votings/'.$hasilVoting->id,
            $editedHasilVoting
        );

        $this->assertApiResponse($editedHasilVoting);
    }

    /**
     * @test
     */
    public function test_delete_hasil_voting()
    {
        $hasilVoting = HasilVoting::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/hasil_votings/'.$hasilVoting->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/hasil_votings/'.$hasilVoting->id
        );

        $this->response->assertStatus(404);
    }
}
