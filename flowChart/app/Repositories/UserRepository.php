<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    public static string $modelClass = User::class;
}
