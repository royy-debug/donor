<?php

namespace App\Filament\Widgets;

use Filament\Support\RawJs;
use Filament\Widgets\PieChartWidget;
use App\Models\Donor;

class DonorStatusChart extends PieChartWidget
{
    protected static ?string $heading = 'Statistik Status Donor';
    protected static ?string $maxHeight = '300px';

protected int | string | array $columnSpan = 1; // ✅ BENAR SESUAI TIPE YANG DIHARAPKAN

    protected function getData(): array
    {
        $data = Donor::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'datasets' => [
                [
                    'data' => [
                        $data['pending'] ?? 0,
                        $data['approved'] ?? 0,
                        $data['rejected'] ?? 0,
                    ],
                    'backgroundColor' => [
                        '#6B7280', // Abu muda
                        '#374151', // Abu gelap
                        '#111827', // Hitam
                    ],
                ],
            ],
            'labels' => ['Pending', 'Approved', 'Rejected'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => RawJs::make(<<<'JS'
                            function(context) {
                                let label = context.label || '';
                                let value = context.parsed || 0;
                                return label + ': ' + Math.round(value);
                            }
                        JS),
                    ],
                ],
            ],
        ];
    }
}
