<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 2/05/18
 * Time: 19:43
 */

namespace App\Application\User\InsertUser;

use App\Domain\Model\Entity\User\EmailExistsException;
use App\Domain\Model\Entity\User\NickNameExistsException;
use App\Domain\Model\Entity\User\UserRepositoryInterface;
use App\Domain\Model\Service\Entity\User\CheckIfUserEmailExists;
use App\Domain\Model\Service\Entity\User\CheckIfUserNicknameExists;

class InsertUser
{
    const KEY_EMAIL = 'email';
    const KEY_NICKNAME = 'nickname';

    const OK = 'Usuario insertado';
    const OK_CODE = 200;

    private $userRepository;
    private $checkIfUserEmailExists;
    private $checkIfUserNicknameExists;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CheckIfUserEmailExists $checkIfUserEmailExists,
        CheckIfUserNicknameExists $checkIfUserNicknameExists
    ) {
        $this->userRepository = $userRepository;
        $this->checkIfUserEmailExists = $checkIfUserEmailExists;
        $this->checkIfUserNicknameExists = $checkIfUserNicknameExists;
    }

    /**
     * @param InsertUserCommand $insertUserCommand
     * @return array
     */
    public function handle(InsertUserCommand $insertUserCommand): array
    {

        try {
            $this->checkIfUserNicknameExists->check(
                self::KEY_NICKNAME,
                $insertUserCommand->getNickName()
            );
        } catch (NickNameExistsException $nex) {
            return ['data' => $nex->getMessage(), 'code' => $nex->getCode()];
        }

        try {
            $this->checkIfUserEmailExists->check(
                self::KEY_EMAIL,
                $insertUserCommand->getEmail()
            );
        } catch (EmailExistsException $eex) {
            return ['data' => $eex->getMessage(), 'code' => $eex->getCode()];
        }

        $userId = $this->userRepository->insertUser(
            $insertUserCommand->getName(),
            $insertUserCommand->getSurname(),
            $insertUserCommand->getBirthDate(),
            $insertUserCommand->getNickName(),
            $insertUserCommand->getEmail(),
            $insertUserCommand->getPassword()
        );

        return [
            "data" => [
                "message" => "Usuario insertado",
                "returnValue" => $userId
            ],
            "code" => self::OK_CODE,
        ];
    }
}