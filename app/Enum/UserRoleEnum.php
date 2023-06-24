<?php

namespace App\Enum;

enum UserRoleEnum:string{

    case admin = 'admin';
    case agent = 'agent';
    case bank = 'bank';
    case user = 'user';
}
