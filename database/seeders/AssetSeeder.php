<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Laptop' => ['Laptop Lenovo ThinkPad', 'Laptop ASUS VivoBook', 'Laptop HP ProBook', 'Laptop Acer Aspire', 'Laptop Dell Latitude'],
            'Proyektor' => ['Proyektor Epson EB-X06', 'Proyektor BenQ MX550', 'Proyektor Optoma X343'],
            'Kursi' => ['Kursi Kerja Ergonomis', 'Kursi Lipat', 'Kursi Rapat', 'Kursi Tamu'],
            'Monitor' => ['Monitor LG 24 Inch', 'Monitor Samsung 27 Inch', 'Monitor Dell 22 Inch'],
            'Printer' => ['Printer Epson L3210', 'Printer Canon G2010', 'Printer HP LaserJet'],
        ];

        $n = 1;
        foreach ($items as $kategori => $namaList) {
            $category = Category::firstOrCreate(['nama_kategori' => $kategori]);

            foreach ($namaList as $nama) {
                Asset::firstOrCreate(
                    ['kode_aset' => 'AST-' . str_pad($n, 3, '0', STR_PAD_LEFT)],
                    [
                        'nama_aset' => $nama,
                        'category_id' => $category->id,
                        'kondisi' => 'baik',
                        'status' => 'available',
                        'lokasi' => 'Gudang Lantai ' . (($n % 3) + 1),
                    ]
                );
                $n++;
            }
        }
    }
}