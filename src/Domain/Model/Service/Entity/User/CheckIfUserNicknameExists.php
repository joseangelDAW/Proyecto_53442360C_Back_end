<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 13:03
 */

namespace App\Domain\Model\Service\Entity\User;


use App\Domain\Model\Entity\User\NickNameExistsException;
use App\Domain\Model\Entity\User\UserRepositoryInterface;

class CheckIfUserNicknameExists
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $keyNickName
     * @param string $value
     * @throws NickNameExistsException
     */
    public function check(string $keyNickName, string $value)
    {
        $output = $this->userRepository->findUserByKey($keyNickName, $value);
        if (!empty($output)) {
            throw new NickNameExistsException();
        }
    }
}