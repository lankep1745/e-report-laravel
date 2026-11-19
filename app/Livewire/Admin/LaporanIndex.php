<?php

namespace App\Livewire\Admin;

use App\Models\Report;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Pengaduan Warga - Admin Kelurahan')]
class LaporanIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $statusFilter = 'all';

    #[Url]
    public string $categoryFilter = 'all';

    // Verification Modal State
    public bool $showVerifyModal = false;
    public ?Report $targetReport = null;
    public string $newStatus = 'diproses';
    public string $adminResponse = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function openVerifyModal(int $id)
    {
        $this->targetReport = Report::with('user')->findOrFail($id);
        $this->newStatus = in_array($this->targetReport->status, ['diproses', 'selesai', 'ditolak']) 
            ? $this->targetReport->status 
            : 'diproses';
        $this->adminResponse = $this->targetReport->admin_response ?? '';
        $this->showVerifyModal = true;
    }

    public function closeVerifyModal()
    {
        $this->showVerifyModal = false;
        $this->targetReport = null;
        $this->reset(['newStatus', 'adminResponse']);
    }

    public function saveVerification()
    {
        $this->validate([
            'newStatus' => ['required', 'in:pending,diproses,selesai,ditolak'],
            'adminResponse' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'newStatus.required' => 'Status laporan wajib dipilih.',
            'adminResponse.required' => 'Catatan / tanggapan resmi dari pihak kelurahan wajib diisi.',
            'adminResponse.min' => 'Catatan tanggapan minimal 10 karakter.',
        ]);

        if (!$this->targetReport) {
            return;
        }

        $this->targetReport->update([
            'status' => $this->newStatus,
            'admin_response' => $this->adminResponse,
            'responded_by' => auth()->id(),
            'responded_at' => now(),
        ]);

        $ticketCode = $this->targetReport->ticket_code;
        $this->closeVerifyModal();

        session()->flash('success', "Status tiket {$ticketCode} berhasil diperbarui menjadi " . strtoupper($this->newStatus) . " beserta tanggapan resmi!");
    }

    public function render()
    {
        $reportsQuery = Report::with(['user', 'responder'])
            ->when($this->search, function ($query) {
                $query->where(function ($sub) {
                    $sub->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('ticket_code', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function ($u) {
                            $u->where('name', 'like', '%' . $this->search . '%')
                              ->orWhere('nik', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->categoryFilter !== 'all', function ($query) {
                $query->where('category', $this->categoryFilter);
            })
            ->latest();

        $reports = $reportsQuery->paginate(10);

        return view('livewire.admin.laporan-index', [
            'reports' => $reports,
            'categories' => Report::CATEGORIES,
        ]);
    }
}
