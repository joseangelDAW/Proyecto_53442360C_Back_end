<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 12:42
 */

namespace App\Domain\Model\Service\Entity\User;

use App\Domain\Model\Entity\User\EmailExistsException;
use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UserRepositoryInterface;


class CheckIfUserEmailExistsWhenUpdate
{
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param string $keyEmail
     * @param string $value
     * @throws EmailExistsException
     */
    public function check(User $user, string $keyEmail, string $value): void
    {
        $output = $this->userRepository->findUserByKey($keyEmail, $value);
        $currentEmail = $this->userRepository->getValueByKey($user, $keyEmail);
        if ($value != $currentEmail && !empty($output)) {
            throw new EmailExistsException();
        }
    }
}