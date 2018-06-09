<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 8/05/18
 * Time: 19:57
 */

namespace App\Application\User\ListUser;

use App\Domain\Model\Entity\User\User;

class ListUserTransform implements ListUserTransformInterface
{
    /**
     * @param User[] $queryInput
     * @return array
     */
    public function transform(array $queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $user) {
            $queryOutput [] =
                [
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "surname" => $user->getSurname(),
                    "birthDate" => $user->getBirthDate()->format('Y-m-d'),
                    "nickName" => $user->getNickname(),
                    "email" => $user->getEmail(),
                    "role" => $user->getRole()
                ];
        }
        return $queryOutput;
    }

}