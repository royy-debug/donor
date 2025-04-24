<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Donor;


class RealtimeDonor extends BaseWidget
{
    protected static bool $isLazy = false;

protected function getListeners(): array
{
    return ['refreshWidget' => '$refresh'];
}

    public function getStats(): array
    {
        return [
            Stat::make('Total Donor', Donor::count())
                ->description('Updated in real-time')
                ->color('success'),
        ];
    }
}
