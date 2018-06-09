<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 8/05/18
 * Time: 19:56
 */

namespace App\Application\User\ListUser;


use App\Domain\Model\Entity\User\UserRepositoryInterface;

class ListUser
{
    private $listUserTransform;
    private $userRepository;

    public function __construct(
        ListUserTransformInterface $listUserTransform,
        UserRepositoryInterface $userRepository
    )
    {
        $this->listUserTransform = $listUserTransform;
        $this->userRepository = $userRepository;
    }

    public function handle(ListUserCommand $listUserCommand): array
    {
        $users = $this->userRepository->listUser();
        return $this->listUserTransform->transform($users);
    }
}