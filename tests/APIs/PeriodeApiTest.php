<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Periode;

class PeriodeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_periode()
    {
        $periode = Periode::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/periodes', $periode
        );

        $this->assertApiResponse($periode);
    }

    /**
     * @test
     */
    public function test_read_periode()
    {
        $periode = Periode::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/periodes/'.$periode->id
        );

        $this->assertApiResponse($periode->toArray());
    }

    /**
     * @test
     */
    public function test_update_periode()
    {
        $periode = Periode::factory()->create();
        $editedPeriode = Periode::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/periodes/'.$periode->id,
            $editedPeriode
        );

        $this->assertApiResponse($editedPeriode);
    }

    /**
     * @test
     */
    public function test_delete_periode()
    {
        $periode = Periode::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/periodes/'.$periode->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/periodes/'.$periode->id
        );

        $this->response->assertStatus(404);
    }
}
