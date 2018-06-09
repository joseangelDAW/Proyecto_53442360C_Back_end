<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 30/05/18
 * Time: 18:31
 */

namespace App\Domain\Model\Service\Entity\User;


use App\Domain\Model\Entity\User\RoleDoesNotMatchException;
use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UserRepositoryInterface;

class CheckIfUserIsAdmin
{
    private $userRepository;

    /**
     * CheckIfUserIsAdmin constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param string $role
     * @throws RoleDoesNotMatchException
     */
    public function check(User $user, string $role)
    {
        if ($role !== $user->getRole()) {
            throw new RoleDoesNotMatchException();
        }
    }
}