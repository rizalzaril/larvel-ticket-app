<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Ticket;
use App\Models\Seller;
use App\Models\BookingTransaction;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalTickets = Ticket::count();
        $totalSellers = Seller::count();
        $totalBooking = BookingTransaction::count();

        return [
            Stat::make('Total Tiket', number_format($totalTickets))
                ->description('Jumlah total tiket yang tersedia')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('success'),

            Stat::make('Total Seller', number_format($totalSellers))
                ->description('Jumlah total seller yang terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Total Booking', number_format($totalBooking))
                ->description('Jumlah total booking yang terdaftar')
                ->descriptionIcon('heroicon-m-folder')
                ->color('success'),
        ];
    }
}
