<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 15/05/18
 * Time: 20:12
 */

namespace App\Domain\Model\Service\Entity\User;


use App\Domain\Model\Entity\User\EmailExistsException;
use App\Domain\Model\Entity\User\UserRepositoryInterface;

class CheckIfUserEmailExists
{
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $keyEmail
     * @param string $value
     * @throws EmailExistsException
     */
    public function check(string $keyEmail, string $value): void
    {
        $output = $this->userRepository->findUserByKey($keyEmail, $value);
        if (!empty($output)) {
            throw new EmailExistsException();
        }
    }
}