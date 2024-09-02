<?php

namespace App\Policies;

use App\Models\Contract;
use App\Models\User;

class ContractPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_admin ? true : false;
    }

    public function viewOne(User $user, Contract $partner): bool
    {
        $isAdmin = $user->is_admin ? true : false;
        return $isAdmin || $user->partner_id === $partner->id;
    }
}
