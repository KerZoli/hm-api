<?php

namespace App\Enums;

enum RolesEnum: string
{
    case SUPER_ADMIN = 'super admin';
    case OWNER = 'owner';
    case MANAGER = 'manager';
    case CLIENT = 'client';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::OWNER => 'Owner',
            self::MANAGER => 'Manager',
            self::CLIENT => 'Client',
        };
    }
}
