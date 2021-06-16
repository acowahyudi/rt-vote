<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Kandidat;

class KandidatApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kandidat()
    {
        $kandidat = Kandidat::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kandidats', $kandidat
        );

        $this->assertApiResponse($kandidat);
    }

    /**
     * @test
     */
    public function test_read_kandidat()
    {
        $kandidat = Kandidat::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kandidats/'.$kandidat->id
        );

        $this->assertApiResponse($kandidat->toArray());
    }

    /**
     * @test
     */
    public function test_update_kandidat()
    {
        $kandidat = Kandidat::factory()->create();
        $editedKandidat = Kandidat::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kandidats/'.$kandidat->id,
            $editedKandidat
        );

        $this->assertApiResponse($editedKandidat);
    }

    /**
     * @test
     */
    public function test_delete_kandidat()
    {
        $kandidat = Kandidat::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kandidats/'.$kandidat->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kandidats/'.$kandidat->id
        );

        $this->response->assertStatus(404);
    }
}
