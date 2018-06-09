<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29/05/18
 * Time: 19:22
 */

namespace App\Application\Pet\ListMatchedPet;


class ListMatchedPetTransform implements ListMatchedPetTransformInterface
{
    /**
     * @param $queryInput
     * @return array
     */
    public function transform(array $queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $pet) {
            $queryOutput [] =
                [
                    "name" => $pet["name"],
                    "image" => $pet["image"],
                    "email" => $pet["email"],
                ];
        }

        return $queryOutput;
    }
}