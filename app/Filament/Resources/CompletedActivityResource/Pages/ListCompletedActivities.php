<?php

namespace App\Filament\Resources\CompletedActivityResource\Pages;

use App\Filament\Resources\CompletedActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompletedActivities extends ListRecords
{
    protected static string $resource = CompletedActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(fn () => auth('admin')->user()?->hasAnyRole(['admin','moderator']) === true),
        ];
    }
}


