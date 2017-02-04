<?php

namespace System\Auth;
use MVC\Models\User;
use System\ORM\Repository;
use System\Pattern\Singleton;

/**
 * Class UserSession
 * @package System\Auth
 *
 * @method static UserSession getInstance()
 */
class UserSession extends Session
{

    use Singleton;

    /**
     * @return null|User
     */
    public function getIdentity()
    {
        $repo = new Repository(User::class);

        /** @var User $user */
        $user = $repo->findOneBy(
            [
                'id' => parent::getIdentity()
            ]
        );

        return $user;
    }

}