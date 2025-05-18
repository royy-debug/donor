<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Donor;

class RealtimeDonor extends BarChartWidget
{
    protected static bool $isLazy = false;
    protected int | string | array $columnSpan = 1; // ✅ BENAR SESUAI TIPE YANG DIHARAPKAN
        protected static ?string $maxHeight = '300px';
        


    protected function getListeners(): array
    {
        return ['refreshWidget' => '$refresh'];
    }

    protected function getData(): array
    {
        $data = collect(range(0, 5))->map(function ($i) {
            $month = now()->subMonths($i);
            return [
                'label' => $month->format('M Y'),
                'count' => Donor::whereYear('created_at', $month->year)
                                ->whereMonth('created_at', $month->month)
                                ->count(),
            ];
        })->reverse();

        return [
            'datasets' => [
                [
                    'label' => 'Donor Masuk',
                    'data' => $data->pluck('count')->map(fn($count) => (int) $count),
                    'backgroundColor' => '#10B981',
                ],
            ],
            'labels' => $data->pluck('label'),
        ];
    }

    protected function getOptions(): ?array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'precision' => 0, // Hapus angka desimal
                        'beginAtZero' => true,
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
