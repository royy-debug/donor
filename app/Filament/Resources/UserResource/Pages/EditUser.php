<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function afterSave(): void
    {
        $data = $this->form->getState();

        $this->record->syncRoles($data['roles'] ?? []);
        $this->record->syncPermissions($data['permissions'] ?? []);
    }
}
