<?php

namespace Tests\Feature;

use Tests\TestCase;

class VerifikasiTest extends TestCase
{
    public function test_halaman_verifikasi_bisa_diakses()
    {
        $response = $this->get('/verifikasi');
        $response->assertStatus(200);
    }

    public function test_approve_pesanan_berhasil()
    {
        $response = $this->post('/verifikasi/1/approve');
        $response->assertStatus(302);
    }

    public function test_reject_pesanan_berhasil()
    {
        $response = $this->post('/verifikasi/1/reject');
        $response->assertStatus(302);
    }
}