<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RukunTetangga;

class RukunTetanggaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rukun_tetangga()
    {
        $rukunTetangga = RukunTetangga::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rukun_tetanggas', $rukunTetangga
        );

        $this->assertApiResponse($rukunTetangga);
    }

    /**
     * @test
     */
    public function test_read_rukun_tetangga()
    {
        $rukunTetangga = RukunTetangga::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/rukun_tetanggas/'.$rukunTetangga->id
        );

        $this->assertApiResponse($rukunTetangga->toArray());
    }

    /**
     * @test
     */
    public function test_update_rukun_tetangga()
    {
        $rukunTetangga = RukunTetangga::factory()->create();
        $editedRukunTetangga = RukunTetangga::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rukun_tetanggas/'.$rukunTetangga->id,
            $editedRukunTetangga
        );

        $this->assertApiResponse($editedRukunTetangga);
    }

    /**
     * @test
     */
    public function test_delete_rukun_tetangga()
    {
        $rukunTetangga = RukunTetangga::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rukun_tetanggas/'.$rukunTetangga->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rukun_tetanggas/'.$rukunTetangga->id
        );

        $this->response->assertStatus(404);
    }
}
