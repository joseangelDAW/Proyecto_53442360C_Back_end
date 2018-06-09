<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 12:15
 */

namespace App\Domain\Model\Service\Entity\User;

use App\Domain\Model\Entity\User\UserDoesNotExistException;
use App\Domain\Model\Entity\User\UserRepositoryInterface;

class CheckIfUserExists
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @throws UserDoesNotExistException
     */
    public function check(int $id): void
    {
        if (is_null($this->userRepository->findUserById($id))) {
            throw new UserDoesNotExistException();
        }
    }
}