<?php

namespace App\Filament\Pages;

use Filament\Pages\BasePage;
use Filament\Panel;

class Dashboard extends BasePage
{
    public function panel(Panel $panel): Panel
    {
        return $panel->pages([]);
    }
}
