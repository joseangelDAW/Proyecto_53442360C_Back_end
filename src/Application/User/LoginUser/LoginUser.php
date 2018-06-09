<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 19/05/18
 * Time: 9:26
 */

namespace App\Application\User\LoginUser;


use App\Domain\Model\Entity\User\RoleDoesNotMatchException;
use App\Domain\Model\Entity\User\LoginFailedException;
use App\Domain\Model\Entity\User\NickNameDoesNotExistException;
use App\Domain\Model\Entity\User\UserConst;
use App\Domain\Model\Entity\User\UserRepositoryInterface;
use App\Domain\Model\Service\Entity\User\CheckIfUserIsAdmin;
use App\Domain\Model\Service\Entity\User\CheckIfUserNicknameDoesNotExist;
use App\Domain\Model\Service\Entity\User\CheckLoginMatchNicknameAndPassword;

class LoginUser
{
    private $userRepository;
    private $loginUserTransform;
    private $checkIfUserNicknameDoesNotExist;
    private $checkLoginMatchNicknameAndPassword;
    private $checkIfUserIsAdmin;

    public function __construct(
        UserRepositoryInterface $userRepository,
        LoginUserTransformInterface $loginUserTransform,
        CheckIfUserNicknameDoesNotExist $checkIfUserNicknameDoesNotExist,
        CheckLoginMatchNicknameAndPassword $checkLoginMatchNicknameAndPassword,
        CheckIfUserIsAdmin $checkIfUserIsAdmin
    ) {
        $this->userRepository = $userRepository;
        $this->loginUserTransform = $loginUserTransform;
        $this->checkIfUserNicknameDoesNotExist = $checkIfUserNicknameDoesNotExist;
        $this->checkLoginMatchNicknameAndPassword = $checkLoginMatchNicknameAndPassword;
        $this->checkIfUserIsAdmin = $checkIfUserIsAdmin;

    }

    /**
     * @param LoginUserCommand $loginUserCommand
     * @return array
     */
    public function handle(LoginUserCommand $loginUserCommand): array
    {
        $nickname = $loginUserCommand->getUser();
        $password = $loginUserCommand->getPassword();
        $role = $loginUserCommand->getRole();

        try {
            $this->checkIfUserNicknameDoesNotExist->check(
                UserConst::NICKNAME,
                $nickname
            );
        } catch (NickNameDoesNotExistException $ndnex) {
            return ['data' => $ndnex->getMessage(), 'code' => $ndnex->getCode()];
        }

        $userEntity = $this->userRepository->findOneUserByNickname($nickname);

        try {
            $this->checkLoginMatchNicknameAndPassword->check(
                $userEntity,
                $password
            );
        } catch (LoginFailedException $lfex) {
            return ['data' => $lfex->getMessage(), 'code' => $lfex->getCode()];
        }

        try {
            $this->checkIfUserIsAdmin->check(
                $userEntity,
                $role
            );
        } catch (RoleDoesNotMatchException $adnex) {
            return ['data' => $adnex->getMessage(), 'code' => $adnex->getCode()];
        }

        $userId = $userEntity->getId();

        return (
            [
                'data' =>
                    [
                        'message' => UserConst::OK_LOGIN,
                        'returnValue' => $userId
                    ],
                'code' => UserConst::OK_LOGIN_CODE
            ]
        );
    }
}