<?php

namespace App\Filament\Resources\CompletedActivityResource\Pages;

use App\Filament\Resources\CompletedActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompletedActivity extends EditRecord
{
    protected static string $resource = CompletedActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(fn () => auth('admin')->user()?->hasRole('admin') === true),
        ];
    }
}


