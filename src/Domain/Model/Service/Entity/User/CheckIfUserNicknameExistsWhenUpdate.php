<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 15/05/18
 * Time: 20:16
 */

namespace App\Domain\Model\Service\Entity\User;


use App\Domain\Model\Entity\User\NickNameExistsException;
use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UserRepositoryInterface;

class CheckIfUserNicknameExistsWhenUpdate
{
    private $userRepository;

    /**
     * CheckIfUserNicknameExistsWhenUpdate constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param string $keyNickName
     * @param string $value
     * @throws NickNameExistsException
     */
    public function check(User $user, string $keyNickName, string $value): void
    {
        $output = $this->userRepository->findUserByKey($keyNickName, $value);
        $currentNickname = $this->userRepository->getValueByKey($user, $keyNickName);
        if ($value != $currentNickname && !empty($output)) {
            throw new NickNameExistsException();
        }
    }
}