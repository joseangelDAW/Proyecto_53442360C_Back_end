<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 19/05/18
 * Time: 11:05
 */

namespace App\Domain\Model\Service\Entity\User;


use App\Domain\Model\Entity\User\LoginFailedException;
use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UserConst;
use App\Domain\Model\Entity\User\UserRepositoryInterface;

class CheckLoginMatchNicknameAndPassword
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function check(User $user, string $password)
    {
        $passwordHashed = $this->userRepository->getValueByKey($user, UserConst::PASSWORD);

        if (false === password_verify ( $password , $passwordHashed )) {
            throw new LoginFailedException();
        }
    }
}