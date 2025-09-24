<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;

    protected function afterCreate(): void
    {
        // Sync Spatie role with selected role field (admin guard)
        $role = (string) ($this->record->role ?? '');
        if ($role !== '') {
            $this->record->syncRoles([$role]);
        }
    }
}
