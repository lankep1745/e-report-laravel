<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Kelurahan
        $admin = User::firstOrCreate(
            ['email' => 'admin@ereport.test'],
            [
                'name' => 'Admin Kelurahan',
                'email' => 'admin@ereport.test',
                'nik' => '3201010101900001',
                'phone' => '081234567890',
                'address' => 'Kantor Kelurahan Sukamaju Lt. 2',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Akun Warga Demo
        $warga = User::firstOrCreate(
            ['email' => 'lana@ereport.test'],
            [
                'name' => 'Lana Khairunnas',
                'email' => 'lana@ereport.test',
                'nik' => '3201011708040001',
                'phone' => '088991885581',
                'address' => 'Jl. Merdeka No. 12, RT 03/RW 05',
                'role' => 'warga',
                'password' => Hash::make('password123'),
            ]
        );

        // Tambahan akun warga untuk variasi di admin list warga
        $warga2 = User::firstOrCreate(
            ['email' => 'budi@ereport.test'],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@ereport.test',
                'nik' => '3201012304910002',
                'phone' => '081298765432',
                'address' => 'Komplek Griya Indah Blok C3 No. 7',
                'role' => 'warga',
                'password' => Hash::make('password123'),
            ]
        );

        // 3. 5 Data Dummy Laporan Warga Demo dengan status berbeda
        $reports = [
            [
                'ticket_code' => 'ERP-2026-0001',
                'user_id' => $warga->id,
                'title' => 'Lampu Penerangan Jalan Umum Rusak di Depan Gapura RW 05',
                'category' => 'Lampu & Kelistrikan',
                'location' => 'Jl. Merdeka RT 03 / RW 05 (Dekat Gapura Masuk)',
                'description' => 'Sudah 4 hari lampu PJU utama padam total pada malam hari. Kondisi jalan sangat gelap dan membahayakan pengendara motor serta memicu kerawanan tindakan kriminal malam hari.',
                'photo_path' => null,
                'status' => 'selesai',
                'admin_response' => 'Tim teknisi Dinas Penerangan Jalan dan Kelurahan telah melakukan pergantian bohlam LED 100W serta perbaikan saklar otomatis pada tanggal 18 November 2026 pukul 14.30 WIB. Lampu kini berfungsi normal.',
                'responded_by' => $admin->id,
                'responded_at' => now()->subDay(),
                'created_at' => now()->subDays(3),
            ],
            [
                'ticket_code' => 'ERP-2026-0002',
                'user_id' => $warga->id,
                'title' => 'Tumpukan Sampah Liar Menggunung di Lahan Kosong Pinggir Sungai',
                'category' => 'Kebersihan & Sampah',
                'location' => 'Bantaran Sungai Ciliwung, Belakang Pos Ronda RT 02',
                'description' => 'Ada oknum yang membuang puing bangunan dan kantong sampah rumah tangga secara liar. Bau menyengat dan mengundang lalat yang mengganggu warga sekitar saat angin bertiup kencang.',
                'photo_path' => null,
                'status' => 'diproses',
                'admin_response' => 'Laporan telah diverifikasi oleh Satgas Kebersihan Kelurahan. Armada truk pengangkut sampah DLH dijadwalkan meluncur besok pagi untuk pembersihan total dan pemasangan spanduk larangan membuang sampah.',
                'responded_by' => $admin->id,
                'responded_at' => now()->subHours(6),
                'created_at' => now()->subDays(2),
            ],
            [
                'ticket_code' => 'ERP-2026-0003',
                'user_id' => $warga->id,
                'title' => 'Aspal Amblas dan Lubang Menganga Sedalam 25 cm',
                'category' => 'Infrastruktur & Jalan',
                'location' => 'Jl. Veteran Depan Apotek Sehat Sentosa',
                'description' => 'Akibat hujan deras semalam, aspal jalan raya amblas membentuk lubang cukup besar dan dalam. Sangat berbahaya bagi pesepeda motor, terutama saat tergenang air hujan.',
                'photo_path' => null,
                'status' => 'pending',
                'admin_response' => null,
                'responded_by' => null,
                'responded_at' => null,
                'created_at' => now()->subHours(12),
            ],
            [
                'ticket_code' => 'ERP-2026-0004',
                'user_id' => $warga->id,
                'title' => 'Drainase Tersumbat Sedimen Lumpur Membeludak ke Badan Jalan',
                'category' => 'Saluran Air & Banjir',
                'location' => 'Gorong-gorong Pertigaan Jl. Flamboyan Indah',
                'description' => 'Air selokan meluap hingga merendam trotoar dan halaman rumah warga setiap hujan gerimis lebih dari 30 menit karena sedimentasi tebal dan sampah dedaunan di saluran air.',
                'photo_path' => null,
                'status' => 'diproses',
                'admin_response' => 'Petunjuk kerja telah diterbitkan untuk Tim PPSU Kelurahan. Pengerukan sedimentasi lumpur sedang berlangsung hari ini.',
                'responded_by' => $admin->id,
                'responded_at' => now()->subHours(3),
                'created_at' => now()->subDay(),
            ],
            [
                'ticket_code' => 'ERP-2026-0005',
                'user_id' => $warga->id,
                'title' => 'Permintaan Penertiban Parkir Liar Truk Ekspedisi',
                'category' => 'Keamanan & Ketertiban',
                'location' => 'Akses Masuk Perumahan Asri Blok D',
                'description' => 'Truk-truk besar ekspedisi sering memarkir kendaraan sembarangan di badan jalan sempit semalaman, menghalangi akses mobil warga dan ambulans.',
                'photo_path' => null,
                'status' => 'pending',
                'admin_response' => null,
                'responded_by' => null,
                'responded_at' => null,
                'created_at' => now()->subHours(2),
            ],
        ];

        foreach ($reports as $reportData) {
            Report::firstOrCreate(['ticket_code' => $reportData['ticket_code']], $reportData);
        }
    }
}
