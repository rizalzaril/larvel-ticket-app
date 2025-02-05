<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;

class SellerChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Penjual';

    // Mengatur lebar widget menjadi full width
    protected static ?string $maxWidth = 'full';

    protected function getData(): array
    {
        // Mengambil jumlah seller berdasarkan bulan pendaftaran
        $sellers = Seller::selectRaw('MONTH(created_at) as month, COUNT(id) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format data untuk Chart.js
        $labels = [];
        $data = [];

        foreach ($sellers as $seller) {
            $labels[] = date("F", mktime(0, 0, 0, $seller->month, 1)); // Konversi angka bulan ke nama bulan
            $data[] = $seller->total;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Penjual',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)', // Warna batang chart
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Jenis chart (bisa 'bar', 'line', 'pie', dll.)
    }
}
