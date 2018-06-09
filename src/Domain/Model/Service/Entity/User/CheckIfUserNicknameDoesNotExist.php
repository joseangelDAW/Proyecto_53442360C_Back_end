<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 19/05/18
 * Time: 11:28
 */

namespace App\Domain\Model\Service\Entity\User;


use App\Domain\Model\Entity\User\NickNameDoesNotExistException;
use App\Domain\Model\Entity\User\UserRepositoryInterface;

class CheckIfUserNicknameDoesNotExist
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $keyNickName
     * @param string $value
     * @throws NickNameDoesNotExistException
     */
    public function check(string $keyNickName, string $value)
    {
        $output = $this->userRepository->findUserByKey($keyNickName, $value);
        if (empty($output)) {
            throw new NickNameDoesNotExistException();
        }
    }
}