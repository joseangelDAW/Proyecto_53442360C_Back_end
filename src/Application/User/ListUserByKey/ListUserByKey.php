<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 15/05/18
 * Time: 20:57
 */

namespace App\Application\User\ListUserByKey;


use App\Domain\Model\Entity\User\UserRepositoryInterface;

class ListUserByKey
{
    private $listUserByKeyTransform;
    private $userRepository;

    public function __construct(
        ListUserByKeyTransformInterface $listUserByKeyTransform,
        UserRepositoryInterface $userRepository
    )
    {
        $this->listUserByKeyTransform = $listUserByKeyTransform;
        $this->userRepository = $userRepository;
    }

    public function handle(ListUserByKeyCommand $listUserByKeyCommand): array
    {
        $user = $this->userRepository
            ->findUserByKey(
                $listUserByKeyCommand->getKey(),
                $listUserByKeyCommand->getValue()
            );
        return $this->listUserByKeyTransform->transform($user);
    }
}