<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 11:28
 */

namespace App\Application\User\UpdateUser;

use App\Domain\Model\Entity\User\EmailExistsException;
use App\Domain\Model\Entity\User\NickNameExistsException;
use App\Domain\Model\Entity\User\UserDoesNotExistException;
use App\Domain\Model\Entity\User\UserRepositoryInterface;
use App\Domain\Model\Service\Entity\User\CheckIfUserExists;
use App\Domain\Model\Service\Entity\User\CheckIfUserEmailExistsWhenUpdate;
use App\Domain\Model\Service\Entity\User\CheckIfUserNicknameExistsWhenUpdate;

class UpdateUser
{
    const KEY_EMAIL = 'email';
    const KEY_NICKNAME = 'nickname';
    const OK = 'Usuario actualizado';
    const OK_CODE = 200;

    private $userRepository;
    private $checkIfUserExists;
    private $checkIfUserEmailExistsWhenUpdate;
    private $checkIfUserNicknameExistsWhenUpdate;

    /**
     * UpdateUser constructor.
     * @param UserRepositoryInterface $userRepository
     * @param CheckIfUserExists $checkIfUserExists
     * @param CheckIfUserEmailExistsWhenUpdate $checkIfUserEmailExistsWhenUpdate
     * @param CheckIfUserNicknameExistsWhenUpdate $checkIfUserNicknameExistsWhenUpdate
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        CheckIfUserExists $checkIfUserExists,
        CheckIfUserEmailExistsWhenUpdate $checkIfUserEmailExistsWhenUpdate,
        CheckIfUserNicknameExistsWhenUpdate $checkIfUserNicknameExistsWhenUpdate
    ) {
        $this->userRepository = $userRepository;
        $this->checkIfUserExists = $checkIfUserExists;
        $this->checkIfUserNicknameExistsWhenUpdate = $checkIfUserNicknameExistsWhenUpdate;
        $this->checkIfUserEmailExistsWhenUpdate = $checkIfUserEmailExistsWhenUpdate;
    }

    /**
     * @param UpdateUserCommand $updateUserCommand
     * @return array
     */
    public function handle(UpdateUserCommand $updateUserCommand): array
    {
        $output = ['data' =>self::OK, 'code' => self::OK_CODE];

        $userId = $updateUserCommand->getId();
        $userName = $updateUserCommand->getName();
        $userSurname = $updateUserCommand->getSurname();
        $userNickName = $updateUserCommand->getNickname();
        $userEmail = $updateUserCommand->getEmail();

        try {
            $this->checkIfUserExists->check($userId);
        } catch (UserDoesNotExistException $unex) {
            return ['data' => $unex->getMessage(), 'code' => $unex->getCode()];
        }

        $userEntity = $this->userRepository->findUserById($userId);

        try {
            $this->checkIfUserEmailExistsWhenUpdate->check(
                $userEntity,
                self::KEY_EMAIL,
                $userEmail
            );
        } catch (EmailExistsException $eex) {
            return ['data' => $eex->getMessage(), 'code' => $eex->getCode()];
        }

        try {
            $this->checkIfUserNicknameExistsWhenUpdate->check(
                $userEntity,
                self::KEY_NICKNAME,
                $userNickName
            );
        } catch (NickNameExistsException $nex) {
            return ['data' => $nex->getMessage(), 'code' => $nex->getCode()];
        }

        $this->userRepository->updateUser(
            $userEntity,
            $userName,
            $userSurname,
            $userNickName,
            $userEmail
        );

        return $output;
    }
}