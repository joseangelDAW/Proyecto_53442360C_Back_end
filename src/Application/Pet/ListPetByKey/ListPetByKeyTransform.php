<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 15:13
 */

namespace App\Application\Pet\ListPetByKey;

use App\Domain\Model\Entity\Pet\Pet;

class ListPetByKeyTransform implements ListPetByKeyTransformInterface
{
    /**
     * @param Pet[] $queryInput
     *
     * @return array
     */
    public function transform(array $queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $pet) {
            $queryOutput [] =
                [
                    "id" => $pet->getId(),
                    "name" => $pet->getName(),
                    "typePet" => $pet->getTypePet(),
                    "sex" => $pet->getSex(),
                    "race" => $pet->getRace(),
                    "birthDate" => $pet->getBirthDate()->format('Y-m-d'),
                    "user"=>
                        [
                            "id"         => $pet->getUser()->getId(),
                            "name"       => $pet->getUser()->getName(),
                            "surname"    => $pet->getUser()->getSurname(),
                            "birth_date" => $pet->getUser()->getBirthDate()->format('Y-m-d'),
                            "nick_name"  => $pet->getUser()->getNickname(),
                            "email"      => $pet->getUser()->getEmail(),
                        ],
                ];
        }

        return $queryOutput;
    }
}
