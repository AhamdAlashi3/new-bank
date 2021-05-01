<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Merchant;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return mixed
     */
    public function viewAny(Merchant $merchant)
    {
        //
        return $merchant->hasPermissionTo('Read-Customers');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Merchant  $merchant
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function view(Merchant $merchant, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return mixed
     */
    public function create(Merchant $merchant)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Merchant  $merchant
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function update(Merchant $merchant, Customer $customer)
    {
        //
        return $merchant->hasPermissionTo('Updata-Customers')?
         Response::allow():Response::deny('You han on permission');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Merchant  $merchant
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function delete(Merchant $merchant, Customer $customer)
    {
        //
        return $merchant->hasPermissionTo('Delete-Customers')
        ? Response::allow() :Response::deny('You have no permission ! ');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Merchant  $merchant
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function restore(Merchant $merchant, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Merchant  $merchant
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function forceDelete(Merchant $merchant, Customer $customer)
    {
        //
    }
}