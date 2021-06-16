<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Penduduk;

class PendudukApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_penduduk()
    {
        $penduduk = Penduduk::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/penduduks', $penduduk
        );

        $this->assertApiResponse($penduduk);
    }

    /**
     * @test
     */
    public function test_read_penduduk()
    {
        $penduduk = Penduduk::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/penduduks/'.$penduduk->id
        );

        $this->assertApiResponse($penduduk->toArray());
    }

    /**
     * @test
     */
    public function test_update_penduduk()
    {
        $penduduk = Penduduk::factory()->create();
        $editedPenduduk = Penduduk::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/penduduks/'.$penduduk->id,
            $editedPenduduk
        );

        $this->assertApiResponse($editedPenduduk);
    }

    /**
     * @test
     */
    public function test_delete_penduduk()
    {
        $penduduk = Penduduk::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/penduduks/'.$penduduk->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/penduduks/'.$penduduk->id
        );

        $this->response->assertStatus(404);
    }
}
