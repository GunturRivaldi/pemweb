<?php

namespace App\Policies;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GuruPolicy
{
    /**
     * Determine whether the user can view any models.
     * Membatasi akses hanya untuk pengguna dengan is_admin = true
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin === true;
    }

    /**
     * Determine whether the user can view the model.
     * Membatasi akses hanya untuk pengguna dengan is_admin = true
     */
    public function view(User $user, Guru $guru): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create models.
     * Membatasi akses hanya untuk pengguna dengan is_admin = true
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     * Membatasi akses hanya untuk pengguna dengan is_admin = true
     */
    public function update(User $user, Guru $guru): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     * Membatasi akses hanya untuk pengguna dengan is_admin = true
     */
    public function delete(User $user, Guru $guru): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Guru $guru): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Guru $guru): bool
    {
        return false;
    }
}
