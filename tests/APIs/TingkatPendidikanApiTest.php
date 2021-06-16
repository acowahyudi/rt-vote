<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TingkatPendidikan;

class TingkatPendidikanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tingkat_pendidikan()
    {
        $tingkatPendidikan = TingkatPendidikan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tingkat_pendidikans', $tingkatPendidikan
        );

        $this->assertApiResponse($tingkatPendidikan);
    }

    /**
     * @test
     */
    public function test_read_tingkat_pendidikan()
    {
        $tingkatPendidikan = TingkatPendidikan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/tingkat_pendidikans/'.$tingkatPendidikan->id
        );

        $this->assertApiResponse($tingkatPendidikan->toArray());
    }

    /**
     * @test
     */
    public function test_update_tingkat_pendidikan()
    {
        $tingkatPendidikan = TingkatPendidikan::factory()->create();
        $editedTingkatPendidikan = TingkatPendidikan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tingkat_pendidikans/'.$tingkatPendidikan->id,
            $editedTingkatPendidikan
        );

        $this->assertApiResponse($editedTingkatPendidikan);
    }

    /**
     * @test
     */
    public function test_delete_tingkat_pendidikan()
    {
        $tingkatPendidikan = TingkatPendidikan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tingkat_pendidikans/'.$tingkatPendidikan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tingkat_pendidikans/'.$tingkatPendidikan->id
        );

        $this->response->assertStatus(404);
    }
}
