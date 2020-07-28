<?php

namespace Modules\CustomFieldOptions\Policies;

use Modules\Accounts\Entities\User;
use Modules\CustomFieldOptions\Entities\CustomFieldOption;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class StorePolicy.
 */
class CustomFieldOptionPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the store.
     * @param User $user
     * @param CustomFieldOption $customField
     * @return bool
     */
    public function view(User $user, CustomFieldOption $customField)
    {
        return $user->isAdmin() || $user->is($customField->store->StoreOwner);
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param \Modules\Accounts\Entities\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->is($store->StoreOwner);
    }

    /**
     * Determine whether the user can update the address.
     *
     * @param \Modules\Accounts\Entities\User $user
     * @param CustomFieldOption $customField
     * @return mixed
     */
    public function update(User $user, CustomFieldOption $customField)
    {
        return $user->isAdmin() || $user->is($customField->store->StoreOwner);
    }

    /**
     * Determine whether the user can delete the address.
     *
     * @param \Modules\Accounts\Entities\User $user
     * @param CustomFieldOption $customField
     * @return mixed
     */
    public function delete(User $user, CustomFieldOption $customField)
    {
        return $user->isAdmin() || $user->is($customField->store->StoreOwner);
    }
}
