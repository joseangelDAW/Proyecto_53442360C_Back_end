<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 29/05/18
 * Time: 14:21
 */

namespace App\Application\Pet\ListPetByUserId;

use App\Domain\Model\Entity\Pet\Pet;

class ListPetByUserIdTransform implements ListPetByUserIdTransformInterface
{
    /**
     * @param $queryInput
     * @return array
     */
    public function transform($queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $pet) {
            $queryOutput [] =
                [
                    "id" => $pet["id"],
                    "userId" => $pet["user_id"],
                    "name" => $pet["name"],
                    "typePet" => $pet["type_pet"],
                    "sex" => $pet["sex"],
                    "race" => $pet["race"],
                    "birthDate" => $pet["birth_date"],
                    "image" => $pet["image"]
                ];
        }

        return $queryOutput;
    }
}