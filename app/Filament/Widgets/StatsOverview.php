<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Новых пользователей за этот месяц',
                User::query()->where('created_at', '>=', Carbon::now()->startOfMonth())->count())
                ->chart(self::getCountUsersRegisteredForLastMonth())
                ->color('success'),
            Stat::make(
                'Активных пользователей',
                User::query()->where('is_confirmed', true)->count()
            ),
            Stat::make(
                'Всего пользователей',
                User::query()->count()
            ),
        ];
    }

    private function getCountUsersRegisteredForLastMonth(): array
    {
        $results = [];
        $startTime = Carbon::now()->startOfMonth();
        $daysLeft = $startTime->diffInDays(Carbon::now());

        for ($i = 0; $i < $daysLeft; $i++) {
            $endTime = $startTime->copy()->addDay();
            $count = DB::table('users')
                ->whereBetween('created_at', [
                    $startTime,
                    $endTime,
                ])
                ->count();
            $results[] = $count;
            $startTime = $endTime;
        }

        return $results;
    }
}
