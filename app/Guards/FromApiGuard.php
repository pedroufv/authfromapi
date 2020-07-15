<?php

namespace App\Guards;

use App\Facades\Api;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class FromApiGuard implements Guard
{
    use GuardHelpers;

    /**
     * CasGuard constructor.
     * @param UserProvider $provider
     */
    public function __construct(UserProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return Authenticatable|null
     */
    public function user()
    {
        return $this->user = Api::getUser(5);
    }

    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = []): bool
    {
        throw new \BadMethodCallException('Unexpected method call');
    }

    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param int $id
     * @return bool
     */
    public function attempt(int $id): bool
    {
        $this->user = Api::getUser($id);

        return ! empty($this->user);
    }
}
