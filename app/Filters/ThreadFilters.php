<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

/**
 * @property  builder
 */
class ThreadFilters extends Filters
{
    protected $filters = ['by'];

    /**
     * Filter a query by a given username.
     *
     * @param string $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->getKey());
    }
}