<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Kelurahan;

class KelurahanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kelurahan()
    {
        $kelurahan = Kelurahan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kelurahans', $kelurahan
        );

        $this->assertApiResponse($kelurahan);
    }

    /**
     * @test
     */
    public function test_read_kelurahan()
    {
        $kelurahan = Kelurahan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kelurahans/'.$kelurahan->id
        );

        $this->assertApiResponse($kelurahan->toArray());
    }

    /**
     * @test
     */
    public function test_update_kelurahan()
    {
        $kelurahan = Kelurahan::factory()->create();
        $editedKelurahan = Kelurahan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kelurahans/'.$kelurahan->id,
            $editedKelurahan
        );

        $this->assertApiResponse($editedKelurahan);
    }

    /**
     * @test
     */
    public function test_delete_kelurahan()
    {
        $kelurahan = Kelurahan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kelurahans/'.$kelurahan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kelurahans/'.$kelurahan->id
        );

        $this->response->assertStatus(404);
    }
}
