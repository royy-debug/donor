<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterSave(): void
    {
        // $data = $this->form->getState();
    
        // // Ambil nama role dari ID yang dipilih user
        // $roleNames = \Spatie\Permission\Models\Role::whereIn('id', $data['roles'] ?? [])->pluck('name')->toArray();
    
        // $this->record->syncRoles($roleNames);
    
        // // Permissions bisa langsung ID, Spatie ga masalah
        // $permissionNames = \Spatie\Permission\Models\Permission::whereIn('id', $data['permissions'] ?? [])->pluck('name')->toArray();
    
        // $this->record->syncPermissions($permissionNames);
    }
    
}
