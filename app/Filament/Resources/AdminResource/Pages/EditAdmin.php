<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn (): bool => $this->record->id !== auth('admin')->id()),
        ];
    }

    protected function afterSave(): void
    {
        // Ensure Spatie role matches the selected role field
        $role = (string) ($this->record->role ?? '');
        if ($role !== '') {
            $this->record->syncRoles([$role]);
        }
    }
}
