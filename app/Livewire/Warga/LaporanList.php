<?php

namespace App\Livewire\Warga;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Riwayat Pengaduan Saya - E-Report Civic')]
class LaporanList extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $statusFilter = 'all';

    // Detail Modal State
    public bool $showDetailModal = false;
    public ?Report $selectedReport = null;

    // Edit Modal State (Hanya untuk status pending)
    public bool $showEditModal = false;
    public ?int $editingReportId = null;
    public string $editTitle = '';
    public string $editCategory = '';
    public string $editLocation = '';
    public string $editDescription = '';
    public $editPhoto = null;
    public ?string $currentPhotoPath = null;

    // Delete confirmation
    public bool $showDeleteModal = false;
    public ?int $deletingReportId = null;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function openDetail(int $id)
    {
        $this->selectedReport = Report::with(['user', 'responder'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->selectedReport = null;
    }

    public function openEdit(int $id)
    {
        $report = Report::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $this->editingReportId = $report->id;
        $this->editTitle = $report->title;
        $this->editCategory = $report->category;
        $this->editLocation = $report->location;
        $this->editDescription = $report->description;
        $this->currentPhotoPath = $report->photo_path;
        $this->editPhoto = null;

        $this->showEditModal = true;
    }

    public function updateReport()
    {
        $this->validate([
            'editTitle' => ['required', 'string', 'max:150'],
            'editCategory' => ['required', 'string', 'in:' . implode(',', Report::CATEGORIES)],
            'editLocation' => ['required', 'string', 'max:255'],
            'editDescription' => ['required', 'string', 'min:20', 'max:3000'],
            'editPhoto' => ['nullable', 'image', 'max:5120'],
        ], [
            'editTitle.required' => 'Judul laporan wajib diisi.',
            'editCategory.required' => 'Kategori pengaduan wajib dipilih.',
            'editLocation.required' => 'Lokasi laporan wajib diisi.',
            'editDescription.required' => 'Deskripsi laporan wajib diisi.',
            'editDescription.min' => 'Deskripsi minimal 20 karakter.',
        ]);

        $report = Report::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($this->editingReportId);

        $photoPath = $report->photo_path;
        if ($this->editPhoto) {
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $this->editPhoto->store('reports', 'public');
        }

        $report->update([
            'title' => $this->editTitle,
            'category' => $this->editCategory,
            'location' => $this->editLocation,
            'description' => $this->editDescription,
            'photo_path' => $photoPath,
        ]);

        $this->showEditModal = false;
        $this->reset(['editingReportId', 'editTitle', 'editCategory', 'editLocation', 'editDescription', 'editPhoto', 'currentPhotoPath']);

        session()->flash('success', 'Laporan berhasil diperbarui!');
    }

    public function confirmDelete(int $id)
    {
        $this->deletingReportId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteReport()
    {
        $report = Report::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($this->deletingReportId);

        if ($report->photo_path && Storage::disk('public')->exists($report->photo_path)) {
            Storage::disk('public')->delete($report->photo_path);
        }

        $report->delete();

        $this->showDeleteModal = false;
        $this->deletingReportId = null;

        session()->flash('success', 'Pengaduan berhasil dihapus.');
    }

    public function render()
    {
        $reportsQuery = Report::where('user_id', auth()->id())
            ->when($this->search, function ($query) {
                $query->where(function ($sub) {
                    $sub->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('ticket_code', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest();

        $reports = $reportsQuery->paginate(8);

        return view('livewire.warga.laporan-list', [
            'reports' => $reports,
            'categories' => Report::CATEGORIES,
        ]);
    }
}
