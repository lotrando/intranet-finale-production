<?php

namespace App\Policies;

use App\Models\Test;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Test $test): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Test $test): bool
    {
    }

    public function delete(User $user, Test $test): bool
    {
    }

    public function restore(User $user, Test $test): bool
    {
    }

    public function forceDelete(User $user, Test $test): bool
    {
    }
}
