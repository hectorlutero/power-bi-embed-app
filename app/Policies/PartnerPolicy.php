<?php

namespace App\Policies;

use App\Models\Partner;
use App\Models\User;

class PartnerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_admin ? true : false;
    }

    public function viewOne(User $user, Partner $partner): bool
    {
        $isAdmin = $user->is_admin ? true : false;
        return $isAdmin || $user->partner_id === $partner->id;
    }
}
