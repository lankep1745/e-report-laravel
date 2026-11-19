<?php

namespace App\Livewire\Warga;

use App\Models\Report;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Buat Pengaduan Baru - E-Report Civic')]
class LaporanBuat extends Component
{
    use WithFileUploads;

    public string $title = '';
    public string $category = '';
    public string $location = '';
    public string $description = '';
    public $photo = null;

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string', 'in:' . implode(',', Report::CATEGORIES)],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:20', 'max:3000'],
            'photo' => ['nullable', 'image', 'max:5120'], // Max 5MB
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'Judul ringkas laporan wajib diisi.',
            'category.required' => 'Silakan pilih kategori pengaduan.',
            'category.in' => 'Kategori yang dipilih tidak valid.',
            'location.required' => 'Lokasi atau patokan kejadian wajib diisi.',
            'description.required' => 'Jelaskan kronologi dan detail masalah yang diadukan.',
            'description.min' => 'Deskripsi minimal 20 karakter agar petugas dapat memahami masalah.',
            'photo.image' => 'Berkas bukti harus berupa gambar (JPG, PNG, WEBP).',
            'photo.max' => 'Ukuran foto maksimal 5 MB.',
        ];
    }

    public function selectCategory(string $category)
    {
        $this->category = $category;
    }

    public function submit()
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('reports', 'public');
        }

        $ticketCode = Report::generateTicketCode();

        $report = Report::create([
            'ticket_code' => $ticketCode,
            'user_id' => auth()->id(),
            'title' => $this->title,
            'category' => $this->category,
            'location' => $this->location,
            'description' => $this->description,
            'photo_path' => $photoPath,
            'status' => 'pending',
        ]);

        session()->flash('success', "Pengaduan berhasil dikirim! Nomor tiket Anda: {$ticketCode}");

        return $this->redirect(route('warga.laporan'), navigate: true);
    }

    public function render()
    {
        return view('livewire.warga.laporan-buat', [
            'categories' => Report::CATEGORIES,
        ]);
    }
}
