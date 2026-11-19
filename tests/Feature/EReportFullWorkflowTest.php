<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EReportFullWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_landing_page_can_be_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Sampaikan Keluhan');
        $response->assertSee('ERP-2026-0001');
    }

    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Masuk ke E-Report');
    }

    public function test_register_page_can_be_rendered(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Pendaftaran Warga');
    }

    public function test_admin_redirect_to_admin_dashboard_on_login(): void
    {
        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'admin@ereport.test')
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();
    }

    public function test_warga_redirect_to_warga_dashboard_on_login(): void
    {
        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'lana@ereport.test')
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect(route('warga.dashboard'));

        $this->assertAuthenticated();
    }

    public function test_role_middleware_blocks_warga_from_admin_area(): void
    {
        $warga = User::where('email', 'lana@ereport.test')->first();

        $response = $this->actingAs($warga)->get('/admin/dashboard');
        $response->assertStatus(403);
        $response->assertSee('Akses Ditolak');
    }

    public function test_role_middleware_blocks_admin_from_warga_area(): void
    {
        $admin = User::where('email', 'admin@ereport.test')->first();

        $response = $this->actingAs($admin)->get('/warga/dashboard');
        $response->assertStatus(403);
        $response->assertSee('Akses Ditolak');
    }

    public function test_warga_can_create_new_report_with_proper_ticket_code(): void
    {
        $warga = User::where('email', 'lana@ereport.test')->first();

        Livewire::actingAs($warga)
            ->test(\App\Livewire\Warga\LaporanBuat::class)
            ->set('title', 'Pohon Tumbang Menimpa Tiang Kabel')
            ->set('category', 'Keamanan & Ketertiban')
            ->set('location', 'Jl. Merpati RT 01/RW 02')
            ->set('description', 'Pohon mangga tua tumbang akibat angin kencang dan saat ini kabel telepon menjuntai rendah ke aspal.')
            ->call('submit')
            ->assertRedirect(route('warga.laporan'));

        $this->assertDatabaseHas('reports', [
            'title' => 'Pohon Tumbang Menimpa Tiang Kabel',
            'ticket_code' => 'ERP-' . date('Y') . '-0006',
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_verify_and_respond_to_report(): void
    {
        $admin = User::where('email', 'admin@ereport.test')->first();
        $pendingReport = Report::where('status', 'pending')->first();

        Livewire::actingAs($admin)
            ->test(\App\Livewire\Admin\LaporanIndex::class)
            ->call('openVerifyModal', $pendingReport->id)
            ->set('newStatus', 'diproses')
            ->set('adminResponse', 'Laporan telah diteruskan ke Dinas Terkait dan surat penugasan telah diterbitkan.')
            ->call('saveVerification')
            ->assertHasNoErrors();

        $pendingReport->refresh();
        $this->assertEquals('diproses', $pendingReport->status);
        $this->assertEquals('Laporan telah diteruskan ke Dinas Terkait dan surat penugasan telah diterbitkan.', $pendingReport->admin_response);
        $this->assertEquals($admin->id, $pendingReport->responded_by);
    }
}
