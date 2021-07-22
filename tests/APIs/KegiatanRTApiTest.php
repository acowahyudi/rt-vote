<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\KegiatanRT;

class KegiatanRTApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kegiatan_r_t()
    {
        $kegiatanRT = KegiatanRT::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kegiatan_r_ts', $kegiatanRT
        );

        $this->assertApiResponse($kegiatanRT);
    }

    /**
     * @test
     */
    public function test_read_kegiatan_r_t()
    {
        $kegiatanRT = KegiatanRT::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kegiatan_r_ts/'.$kegiatanRT->id
        );

        $this->assertApiResponse($kegiatanRT->toArray());
    }

    /**
     * @test
     */
    public function test_update_kegiatan_r_t()
    {
        $kegiatanRT = KegiatanRT::factory()->create();
        $editedKegiatanRT = KegiatanRT::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kegiatan_r_ts/'.$kegiatanRT->id,
            $editedKegiatanRT
        );

        $this->assertApiResponse($editedKegiatanRT);
    }

    /**
     * @test
     */
    public function test_delete_kegiatan_r_t()
    {
        $kegiatanRT = KegiatanRT::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kegiatan_r_ts/'.$kegiatanRT->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kegiatan_r_ts/'.$kegiatanRT->id
        );

        $this->response->assertStatus(404);
    }
}
