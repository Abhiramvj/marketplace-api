<?php

namespace App\Enums\Users;

enum UserRole: string
{
    case ADMIN = 'admin';
    case VENDOR = 'vendor';
    case CUSTOMER = 'customer';
}
